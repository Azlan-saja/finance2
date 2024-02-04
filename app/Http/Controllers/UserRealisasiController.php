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


class UserRealisasiController extends Controller
{
    public function __construct()
    {
         $this->middleware(['auth','user-access:RA|SD|SMP']);          
    }

    public function index($rencana_id)
    {                                                   
        $rencana = Rencana::where('id',$rencana_id)
                    ->where('unit',Auth::user()->lvl)
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

                            $realiasi = $realiasi_raw->get(['b1','b2','b3','b4','b5','b6','b7','b8','b9','b10','b11','b12']);
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
            return view('user.realisasi.index',compact('rencana','rencana_id'));                             
        }else{
             return redirect()->route('user.rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Tidak Ditemukan.');
 
        }
    }


    public function create($rencana_id, $kegiatan_id, $bulan)
    {
        $kegiatan = RencanaDetailKegiatan::where('id',$kegiatan_id)->first(['id', 'rencana_id','rencana_detail_id','rencana_detail_subbagian_id','nama_kegiatan','volume']);
        if($kegiatan && $kegiatan->rencana_id == $rencana_id && $bulan <= 12 && $kegiatan->volume >= $bulan ){
            $nominal = 0;
            $xbulan = 'b'.$bulan;

            $rencana = Rencana::find($kegiatan->rencana_id);
            $rencanadetail = RencanaDetail::find($kegiatan->rencana_detail_id);
            $rencanasubbagian = RencanaDetailSubBagian::find($kegiatan->rencana_detail_subbagian_id);

            $realisasi = Realisasi::where('rencana_id', $kegiatan->rencana_id)
                            ->where('rencana_detail_id', $kegiatan->rencana_detail_id)
                            ->where('rencana_detail_subbagian_id', $kegiatan->rencana_detail_subbagian_id)
                            ->where('rencana_detail_kegiatan_id', $kegiatan->id)
                            ->first();
            if ($realisasi) $nominal = $realisasi->$xbulan;
            return view('user.realisasi.create',compact('nominal','rencana', 'rencanadetail', 'rencanasubbagian', 'kegiatan', 'rencana_id', 'kegiatan_id', 'bulan'));                                    
        }else{
            return redirect()->route('user.realisasi.index', $rencana_id)
                        ->with('error','Uraian Kegiatan Realisasi Tidak Ditemukan.');
        }
    }

    public function store(Request $request, $rencana_id, $kegiatan_id, $bulan)
    {
        $request->validate([
            'nominal' => 'required',
            'rencana_id' => 'required',
            'rencana_detail_id' => 'required',
            'rencana_detail_subbagian_id' => 'required',
            'rencana_detail_kegiatan_id' => 'required',
            'subbagian_id' => 'required',
            'bagian_id' => 'required',
        ]);
        // return $request->all();
        $realisasi = Realisasi::updateOrCreate(
            [
                'rencana_id' => $request->rencana_id, 
                'rencana_detail_id' => $request->rencana_detail_id, 
                'rencana_detail_subbagian_id' => $request->rencana_detail_subbagian_id, 
                'rencana_detail_kegiatan_id' => $request->rencana_detail_kegiatan_id, 
                'subbagian_id' => $request->subbagian_id, 
                'bagian_id' => $request->bagian_id, 
            ],
            [
                'b'.$bulan => str_replace('.','',$request->nominal), 
            ]
        );
        if ($realisasi){
            return redirect()->route('user.realisasi.index', $rencana_id)
                        ->with('success','Input Realisasi Anggaran Berhasil.');
        }else{
              return redirect()->route('user.realisasi.index', $rencana_id)
                        ->with('error','Gagal Input Realisasi Anggaran.');
        }
    }


}
