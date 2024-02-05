<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use Illuminate\Http\Request;

use App\Models\Pemasukan;
use App\Models\Rencana;
use App\Models\Realisasi;
use App\Models\Beban;
use DB;
use Illuminate\Support\Facades\Auth;

class LabaRugiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS|RA|SD|SMP']);
    }
    public function index()
    {       
        return view('yys.laba-rugi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        if (Auth::user()->lvl == 3){
             $request->validate([
            'unit' => 'required',
            'tahun' => 'required|max:9',
            ]);
            $unit = $request->unit;
            $tahun = $request->tahun;
        }else{
            $request->validate([                
                'tahun' => 'required|max:9',
            ]);
            $unit = Auth::user()->lvl;
            $tahun = $request->tahun;
        }
       

        $pengeluaran = [];
        $data_pengeluaran = [];
        $pemasukan = [];
      
        if ($unit == 4){
            $hasil = collect();
            for ($i=3; $i >= 0; $i--){ 
                 $x = new \stdClass();
                 $x->unit =  ["RA", "SD", "SMP", "YYS"][$i];
                 $x->tahun = $tahun; 
                    $rencana = Rencana::where('unit',$i)->where('tahun',$tahun)->first();
                    if($rencana){                                                     
                        $pemasukan_raw = Pemasukan::where('unit',$i)->where('tahun',$tahun)->latest();
                        $pemasukan['total'] =$pemasukan_raw->sum('nominal');
                        $pemasukan['data'] = $pemasukan_raw->get(['nama','sumber','nominal']);                                             

                        $realiasi_raw = Realisasi::where('rencana_id',$rencana->id)
                                ->orderBy('bagian_id', 'asc')
                                ->orderBy('subbagian_id', 'asc')
                                ->orderBy('rencana_detail_kegiatan_id', 'asc')
                                ->with('kegiatans');
                        $realisasi = $realiasi_raw->get();
                        $data_pengeluaran =[];
                        foreach ($realisasi as $key => $value) {            
                            $a = [];
                            $a['nama'] = $value->kegiatans->nama_kegiatan;
                            $a['nominal'] = $value->b1 + $value->b2 + $value->b3 + $value->b4 + $value->b5 + $value->b6 + $value->b7 + $value->b8 + $value->b9 + $value->b10 + $value->b11 + $value->b12;                      
                            $data_pengeluaran[] = $a;

                        }
                        $pengeluaran['total'] =$realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));                        
                        $pengeluaran['data'] = $data_pengeluaran;
 
                        $x->total_pemasukan = $pemasukan['total'] ;
                        $x->total_pengeluaran = $pengeluaran['total'];
                        $x->pendapatan = $pemasukan['total'] - $pengeluaran['total'];
                        $x->pemasukan = $pemasukan;
                        $x->pengeluaran = $pengeluaran;

                        // return view('yys.laba-rugi.search',compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan'));
                    }else{
                        $x->total_pemasukan = 0;
                        $x->total_pengeluaran = 0;
                        $x->pendapatan = 0;
                        $x->pemasukan = [
                            'total' => 0,
                            'data' => [],
                        ];
                        $x->pengeluaran = [
                            'total' => 0,
                            'data' => [],
                        ];
                    }                
                 $hasil->push($x);
            }
            // substr($tahun, 5, 4);
            $xmasuk = substr($tahun, 0, 4);
            $beban = Beban::where('akhir','>=',$xmasuk)                       
                            ->get();        
            // return $beban;
            // return $hasil;
            return view('yys.laba-rugi.search-all',compact('hasil','beban'));


        }else{
            $rencana = Rencana::where('unit',$unit)->where('tahun',$tahun)->first();
                if($rencana){      
                    $realiasi_raw = Realisasi::where('rencana_id',$rencana->id)
                                    ->orderBy('bagian_id', 'asc')
                                    ->orderBy('subbagian_id', 'asc')
                                    ->orderBy('rencana_detail_kegiatan_id', 'asc')
                                    ->with('kegiatans');
                    $realisasi = $realiasi_raw->get();
                    foreach ($realisasi as $key => $value) {            
                        $a = [];
                        $a['nama'] = $value->kegiatans->nama_kegiatan;
                        $a['nominal'] = $value->b1 + $value->b2 + $value->b3 + $value->b4 + $value->b5 + $value->b6 + $value->b7 + $value->b8 + $value->b9 + $value->b10 + $value->b11 + $value->b12;                      
                        $data_pengeluaran[] = $a;

                    }

                    $pengeluaran['total'] =$realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));
                    $pengeluaran['data'] = $data_pengeluaran;
                    
                    $pemasukan_raw = Pemasukan::where('unit',$unit)->where('tahun',$tahun)->latest();
                    $pemasukan['total'] =$pemasukan_raw->sum('nominal');
                    $pemasukan['data'] = $pemasukan_raw->get(['nama','sumber','nominal']);

                    $unit = $rencana->unit;
                    $pendapatan = $pemasukan['total'] - $pengeluaran['total'];     
                            
                    return view('yys.laba-rugi.search',compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan'));
                }else{
                    return redirect()->back()->withInput()
                                ->with('error','Laba Rugi Tidak Ditemukan.');
            
                }    
        }    

    }

}
