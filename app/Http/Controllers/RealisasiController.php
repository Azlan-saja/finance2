<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Realisasi;
use App\Models\Rencana;
use App\Models\RencanaDetail;
use App\Models\RencanaDetailSubBagian;
use App\Models\RencanaDetailKegiatan;

use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Rules\File;
// use Illuminate\Support\Facades\Validator;

class RealisasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }
    
    public function index($rencana_id)
    {                                                   
        $rencana = Rencana::where('id',$rencana_id)
                    // ->where('status','Closed')                 
                    // ->where('status_realisasi','Open')                 
                    ->first(['anggaran','unit','tahun']);       
        if ($rencana){           
            $rencana['bagian'] = [];
            $rencana_detail = RencanaDetail::where('rencana_id',$rencana_id)->orderBy('bagian_id','asc')->get(['id','nama_bagian']);
            
            $total_all = 0;

            foreach ($rencana_detail as $key => $value) {
                
                $total_bagian = 0;               
                
                $rencana['bagian'] = $rencana_detail;
                $rencana_detail_subbagian = RencanaDetailSubBagian::where('rencana_detail_id', $value->id)->orderBy('subbagian_id','asc')->get(['id','nama_subbagian']);                
                foreach ($rencana_detail_subbagian as $key2 => $value2) {
                    
                    $value2['kegiatan'] = [];
                    $total_subbagian = 0;

                    $rencana_detail_kegiatan = RencanaDetailKegiatan::where('rencana_detail_subbagian_id', $value2->id)->oldest();
                    $rencana_detail_kegiatan2 = $rencana_detail_kegiatan->get(['id','nama_kegiatan','sasaran','anggaran','satuan','jumlah_sasaran','volume','harga']);
                    foreach ($rencana_detail_kegiatan2 as $key3 => $value3) {
                        $value3['realisasi'] = [] ;
                        $value3['total_realisasi'] = 0 ;                       
                        
                       
                        $value2['kegiatan'] = $rencana_detail_kegiatan2;

                        $realiasi_raw = Realisasi::where('rencana_id', $rencana_id)
                            ->where('rencana_detail_id', $value->id)
                            ->where('rencana_detail_subbagian_id', $value2->id)
                            ->where('rencana_detail_kegiatan_id', $value3->id);

                            $realiasi = $realiasi_raw->get(['b1','b2','b3','b4','b5','b6','b7','b8','b9','b10','b11','b12','pdf_1','pdf_2','pdf_3','pdf_4','pdf_5','pdf_6','pdf_7','pdf_8','pdf_9','pdf_10','pdf_11','pdf_12']);
                            $value3['realisasi'] = $realiasi;
                            $value3['total_realisasi'] =  $realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));
                            $total_subbagian += $value3['total_realisasi'];
                    }
                    
                    $value2['total_subbagian'] = $total_subbagian;                  
                    $value['subbgaian'] = $rencana_detail_subbagian;
                    $total_bagian += $total_subbagian;
                }
                $value['total_bagian'] = $total_bagian;
                $total_all += $total_bagian;
            } 
            $rencana['total_all'] = $total_all;
            // return $rencana;
            return view('yys.realisasi.index',compact('rencana','rencana_id'));                             
        }else{
             return redirect()->route('rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Belum Closed.');
 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rencana_id, $kegiatan_id, $bulan)
    {
        $kegiatan = RencanaDetailKegiatan::where('id',$kegiatan_id)->first(['id', 'rencana_id','rencana_detail_id','rencana_detail_subbagian_id','nama_kegiatan','volume']);
        // if($kegiatan && $kegiatan->rencana_id == $rencana_id && $bulan <= 12 && $kegiatan->volume >= $bulan ){
        if($kegiatan && $kegiatan->rencana_id == $rencana_id && $bulan <= 12 && $bulan >=1 ){
            $nominal = 0;
            $xbulan = 'b'.$bulan;            
            $fileName = null;
            $xpdf = 'pdf_'.$bulan;

            $rencana = Rencana::where('id',$kegiatan->rencana_id)
                        ->where('status_realisasi','Open')
                        ->first();
            if($rencana){
                $rencanadetail = RencanaDetail::find($kegiatan->rencana_detail_id);
                $rencanasubbagian = RencanaDetailSubBagian::find($kegiatan->rencana_detail_subbagian_id);

                $realisasi = Realisasi::where('rencana_id', $kegiatan->rencana_id)
                                ->where('rencana_detail_id', $kegiatan->rencana_detail_id)
                                ->where('rencana_detail_subbagian_id', $kegiatan->rencana_detail_subbagian_id)
                                ->where('rencana_detail_kegiatan_id', $kegiatan->id)
                                ->first();
                if ($realisasi) $nominal = $realisasi->$xbulan;
                if ($realisasi) $fileName = $realisasi->$xpdf;
                return view('yys.realisasi.create',compact('nominal','rencana', 'rencanadetail', 'rencanasubbagian', 'kegiatan', 'rencana_id', 'kegiatan_id', 'bulan','fileName'));                                    
            }else{
             return redirect()->route('realisasi.index', $rencana_id)
                        ->with('error','Realisasi Anggaran Belanja Sudah Di Tutup.');
            }
        }else{
            return redirect()->route('realisasi.index', $rencana_id)
                        ->with('error','Uraian Kegiatan Realisasi Tidak Ditemukan.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $rencana_id, $kegiatan_id, $bulan)
    {
        // return $request->all();
        // dd($request->file('bukti'));
        $request->validate([
            'nominal' => 'required',
            'rencana_id' => 'required',
            'rencana_detail_id' => 'required',
            'rencana_detail_subbagian_id' => 'required',
            'rencana_detail_kegiatan_id' => 'required',
            'subbagian_id' => 'required',
            'bagian_id' => 'required',            
            'bukti' => 'nullable|mimes:pdf|max:1024',          
        ]);
        // return $request->all();
        $pdf = $request->file('bukti');
        // return $pdf->hashName();       
        // Storage::delete('bukti/EihSFwv7pxrGE6Rn5bdnYstWU2Brx6wgcecUAFiV.pdf');
        $realisasi = Realisasi::where('rencana_id',$request->rencana_id)
                                ->where('rencana_detail_id',$request->rencana_detail_id)
                                ->where('rencana_detail_subbagian_id',$request->rencana_detail_subbagian_id)
                                ->where('rencana_detail_kegiatan_id',$request->rencana_detail_kegiatan_id)
                                ->where('subbagian_id',$request->subbagian_id)
                                ->where('bagian_id',$request->bagian_id)->first();

        if ($realisasi){            
            // Simpan dan Hapus PDF
             if ($request->hasFile('bukti')) {   
                // Simpan PDF
                $pdf->storeAs('bukti', $pdf->hashName());
                // Hapus PDF
                $fields = 'pdf_'.$bulan;
                Storage::delete('bukti/'.basename($realisasi->$fields));

                $realisasi->update([
                    'b'.$bulan => str_replace('.','',$request->nominal), 
                    'pdf_'.$bulan => $pdf->hashName(), 
                ]);                          
            }else{
                 $realisasi->update([
                    'b'.$bulan => str_replace('.','',$request->nominal), 
                ]);
            }
        }else{           
            if ($request->hasFile('bukti')) {            
                // Simpan PDF
                $pdf->storeAs('bukti', $pdf->hashName());   
                Realisasi::create([
                    'rencana_id' => $request->rencana_id,
                    'rencana_detail_id' => $request->rencana_detail_id,
                    'rencana_detail_subbagian_id' => $request->rencana_detail_subbagian_id,
                    'rencana_detail_kegiatan_id' => $request->rencana_detail_kegiatan_id,
                    'subbagian_id' => $request->subbagian_id,
                    'bagian_id' => $request->bagian_id,
                    'b'.$bulan => str_replace('.','',$request->nominal), 
                    'pdf_'.$bulan => $pdf->hashName(), 
                ]);
            }else{
                  Realisasi::create([
                    'rencana_id' => $request->rencana_id,
                    'rencana_detail_id' => $request->rencana_detail_id,
                    'rencana_detail_subbagian_id' => $request->rencana_detail_subbagian_id,
                    'rencana_detail_kegiatan_id' => $request->rencana_detail_kegiatan_id,
                    'subbagian_id' => $request->subbagian_id,
                    'bagian_id' => $request->bagian_id,
                    'b'.$bulan => str_replace('.','',$request->nominal), 
                ]);
            }
        }
        return redirect()->route('realisasi.index', $rencana_id)
                         ->with('success','Input Realisasi Anggaran Berhasil.');
    
        // $realisasi = Realisasi::updateOrCreate(
        //     [
        //         'rencana_id' => $request->rencana_id, 
        //         'rencana_detail_id' => $request->rencana_detail_id, 
        //         'rencana_detail_subbagian_id' => $request->rencana_detail_subbagian_id, 
        //         'rencana_detail_kegiatan_id' => $request->rencana_detail_kegiatan_id, 
        //         'subbagian_id' => $request->subbagian_id, 
        //         'bagian_id' => $request->bagian_id, 
        //     ],
        //     [
        //         'b'.$bulan => str_replace('.','',$request->nominal), 
        //         'pdf_'.$bulan => $pdf->hashName(), 
        //     ]
        // );
        // if ($realisasi){
        //     return redirect()->route('realisasi.index', $rencana_id)
        //                 ->with('success','Input Realisasi Anggaran Berhasil.');
        // }else{
        //       return redirect()->route('realisasi.index', $rencana_id)
        //                 ->with('error','Gagal Input Realisasi Anggaran.');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Realisasi $realisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Realisasi $realisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Realisasi $realisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Realisasi $realisasi)
    {
        //
    }
}
