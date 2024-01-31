<?php

namespace App\Http\Controllers;

use App\Models\RencanaDetail;
use Illuminate\Http\Request;

use App\Models\Rencana;
use App\Models\Bagian;
use App\Models\SubBagian;
use App\Models\Kegiatan;
use App\Models\Sasaran;
use App\Models\Anggaran;
use App\Models\Satuan;
use App\Models\RencanaDetailSubBagian;
use App\Models\RencanaDetailKegiatan;

use Illuminate\Support\Facades\Auth;
use DB;

class RencanaDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function index(Request $request, $id)
    {              
                                         
        $rencana = Rencana::where('id',$id)->where('status','Open')->first();       
        if ($rencana){
            $bagian = Bagian::where('type', $rencana->lvl)->oldest()->with('subbagians')->oldest()->get();   
            $totalsubbagian = 0;
            $jumlah_kegiatan = 0;
            $totalbagian = 0;
            $grandtotal = 0;
            
            foreach ($bagian as $key => $value) {
                foreach ($value['subbagians'] as $key2 => $value2) {                
                    $kegiatan = RencanaDetailKegiatan::where('rencana_id', $id)
                                        ->where('subbagian_id', $value2->id)->oldest();                                                                                     
                    $totalsubbagian = $kegiatan->sum(DB::raw('volume*harga'));  
                    $value2['totalsubbagian'] = $totalsubbagian;                  
                    $value2['jumlah_kegiatan'] = $kegiatan->count();                        
                    $value2['kegiatan'] = $kegiatan->get(); 
                    $grandtotal += $totalsubbagian;
                }
                                 
            }
            $rencana['grandtotal'] = $grandtotal;

            return view('yys.rencana-detail.index',compact('rencana','bagian','id'));                             
        }else{
             return redirect()->route('rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Sudah Closed.');
 
        }
    }
    public function history($rencana_id)
    {                                                   
        $rencana = Rencana::where('id',$rencana_id)->first(['anggaran','unit','tahun']);       
        if ($rencana){
            $grandtotal = 0;
            $rencana['bagian'] = [];
            $rencana_detail = RencanaDetail::where('rencana_id',$rencana_id)->orderBy('bagian_id','asc')->get(['id','nama_bagian']);
            foreach ($rencana_detail as $key => $value) {
                $subtotal = 0;
                $rencana['bagian'] = $rencana_detail;
                $rencana_detail_subbagian = RencanaDetailSubBagian::where('rencana_detail_id', $value->id)->orderBy('subbagian_id','asc')->get(['id','nama_subbagian']);                
                foreach ($rencana_detail_subbagian as $key2 => $value2) {
                    $value2['kegiatan'] = [];
                    
                    $rencana_detail_kegiatan = RencanaDetailKegiatan::where('rencana_detail_subbagian_id', $value2->id)->oldest();
                    $rencana_detail_kegiatan2 = $rencana_detail_kegiatan->get(['nama_kegiatan','sasaran','anggaran','satuan','jumlah_sasaran','volume','harga']);
                    foreach ($rencana_detail_kegiatan2 as $key3 => $value3) {
                        
                        $value2['subtotal2'] = $rencana_detail_kegiatan->sum(DB::raw('volume*harga'));
                        $value2['kegiatan'] = $rencana_detail_kegiatan2;
                        
                    }
                    $subtotal += $value2['subtotal2'];
                    $value['subtotal'] = $subtotal;
                    $value['subbgaian'] = $rencana_detail_subbagian;
                }
                $grandtotal += $subtotal;
            }
            $rencana['grandtotal'] = $grandtotal;
            // return $rencana;
            return view('yys.rencana-detail.history',compact('rencana'));                             
        }else{
             return redirect()->route('rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Tidak Ditemukan.');
 
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $rencana_id, $subbagian_id)
    {        

       $rencana = Rencana::where('id',$rencana_id)                    
                    ->where('status','Open')                   
                    ->first();
        
        if ($rencana){
            $subbagian = SubBagian::where('id',$subbagian_id)
                    ->with('bagians')
                    ->whereRelation('bagians','type',$rencana->lvl)->first();                
            if ($subbagian){
                $kegiatan = Kegiatan::OrderBy('kegiatan','asc')->get();
                $sasaran = Sasaran::OrderBy('sasaran','asc')->get();       
                $anggaran = Anggaran::OrderBy('anggaran','asc')->get();
                $satuan = Satuan::OrderBy('satuan','asc')->get();
                $grantotal = 0;

                $rencanadetailKeg = RencanaDetailKegiatan::where('rencana_id', $rencana_id)
                                    ->where('subbagian_id', $subbagian_id);
                $grantotal = $rencanadetailKeg->sum(DB::raw('volume*harga'));

                if ($request->sort && $request->order){
                    $rencanadetailkegiatan = $rencanadetailKeg->orderBy($request->sort, $request->order)->paginate(5);  
                }else{
                    $rencanadetailkegiatan = $rencanadetailKeg->latest()->paginate(5);         
                }
                
                return view('yys.rencana-detail.create',
                            compact('rencana','subbagian','kegiatan',
                                    'sasaran','anggaran','satuan', 'rencana_id',
                                    'rencanadetailkegiatan','grantotal'))
                            ->with('i', (request()->input('page', 1) - 1) * 5);  
            }else{
                return response()->view('errors.check-permission'); 
            }
        }else{
              return redirect()->route('rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Sudah Closed.');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $rencana_id, $subbagian)
    {
         $request->validate([
            'bagian_id' => 'required',
            'nama_bagian' => 'required',
            'subbagian_id' => 'required',
            'nama_subbagian' => 'required',
            'nama_kegiatan' => 'required',
            'sasaran' => 'required',
            'anggaran' => 'required',
            'satuan' => 'required',
            'jumlah_sasaran' => 'required',
            'volume' => 'required|integer|between:1,12',
            'harga' => 'required',
        ]);      

        // return $request->all();
        $rencanadetail = RencanaDetail::firstOrNew(
            [
                'rencana_id' =>  $rencana_id, 
                'bagian_id' =>  $request->bagian_id, 
            ],[
                'rencana_id' => $rencana_id,
                'bagian_id' => $request->bagian_id,
                'nama_bagian' => $request->nama_bagian,
        ]);        
        $rencanadetail->save();
       
        $rencanadetailsubbagian = RencanaDetailSubBagian::firstOrNew(
            [
                'rencana_detail_id' =>  $rencanadetail->id, 
                'subbagian_id' =>  $request->subbagian_id, 
            ],[
                'rencana_detail_id' => $rencanadetail->id,
                'subbagian_id' => $request->subbagian_id,
                'nama_subbagian' => $request->nama_subbagian,
        ]);        
        $rencanadetailsubbagian->save();       

        $rencanadetailkegiatan = RencanaDetailKegiatan::where('rencana_detail_subbagian_id', $rencanadetailsubbagian->id) 
                ->where('nama_kegiatan', $request->nama_kegiatan)->first();
        if ($rencanadetailkegiatan){
            return redirect()->back()
                ->with('error','Gagal! Data Uraian Kegiatan Sudah Pernah Ditambahkan.');        
        }else{
            RencanaDetailKegiatan::create([
                'rencana_id' => $rencana_id,
                'rencana_detail_id' => $rencanadetail->id,
                'rencana_detail_subbagian_id' => $rencanadetailsubbagian->id,
                'subbagian_id' => $request->subbagian_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'sasaran' => $request->sasaran ,
                'anggaran' => $request->anggaran ,
                'satuan' => $request->satuan ,
                'jumlah_sasaran' => $request->jumlah_sasaran ,
                'volume' => $request->volume ,
                'harga' => $request->harga ,    
            ]);         
             return redirect()->back()
                ->with('success','Tambah Data Uraian Kegiatan Rencana Anggaran Belanja - RAB Berhasil.');
        }       
    }

    /**
     * Display the specified resource.
     */
    public function show(RencanaDetail $rencanaDetail)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RencanaDetail $rencanaDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RencanaDetail $rencanaDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rencana_id, $subbagian, $rencanaDetail)
    {
        $kegiatan = RencanaDetailKegiatan::where('rencana_id', $rencana_id)
                    ->where('subbagian_id', $subbagian)
                    ->where('id', $rencanaDetail)
                    ->first();
        $kegiatan->delete();         
        return redirect()->back()
                ->with('success','Hapus Data Uraian Kegiatan Berhasil.');
    }
}
