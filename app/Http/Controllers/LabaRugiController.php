<?php

namespace App\Http\Controllers;

use App\Models\LabaRugi;
use Illuminate\Http\Request;

use App\Models\Pemasukan;
use App\Models\Rencana;
use App\Models\Realisasi;
use DB;

class LabaRugiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
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
        $request->validate([
            'unit' => 'required',
            'tahun' => 'required|max:9',
        ]);
        $unit = $request->unit;
        $tahun = $request->tahun;

        $pengeluaran = [];
        $data_pengeluaran = [];
        $pemasukan = [];
      
        
        $pemasukan_raw = Pemasukan::where('unit',$unit)->where('tahun',$tahun)->latest();
        // ---------------
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
        
            $pemasukan['total'] =$pemasukan_raw->sum('nominal');
            $pemasukan['data'] = $pemasukan_raw->get(['nama','sumber','nominal']);

            $unit = $rencana->unit;
            $pendapatan = $pemasukan['total'] - $pengeluaran['total'];
            // return [$unit, $tahun, $pemasukan,$pengeluaran];
            // return $pengeluaran;
            return view('yys.laba-rugi.search',compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan'));
        }else{
             return redirect()->back()->withInput()
                        ->with('error','Laba Rugi Tidak Ditemukan.');
       
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LabaRugi $labaRugi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabaRugi $labaRugi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabaRugi $labaRugi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabaRugi $labaRugi)
    {
        //
    }
}
