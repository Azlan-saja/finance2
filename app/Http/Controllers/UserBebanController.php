<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Beban;
use Illuminate\Support\Facades\Auth;


class UserBebanController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'user-access:RA|SD|SMP']);
    }
    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $beban = Beban::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $beban = Beban::latest()->paginate(5);         
        }
        return view('user.beban.index',compact('beban'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $beban = Beban::where('nama','like','%'.$request->cari.'%')
                ->orWhere('nama','like','%'.$request->cari.'%')            
                ->orWhere('besaran','like','%'.$request->cari.'%')            
                ->orWhere('masuk','like','%'.$request->cari.'%')            
                ->orWhere('akhir','like','%'.$request->cari.'%')            
                ->latest()->paginate(5);                  
        return view('user.beban.index',compact('beban'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {        
        return view('user.beban.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'besaran' => 'required',
            'masuk' => 'required|min:4|max:4',
            'akhir' => 'required|min:4|max:4|gte:masuk',
            ],
            [
                'akhir.gte' => 'Tahun Akhir Harus Lebih Besar Dari Tahun Masuk.',
            ]
        );   
        
        Beban::create($request->all());         
        return redirect()->route('user.beban.index')
                        ->with('success','Tambah Data Beban Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Beban $beban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beban $beban)
    {
        return view('user.beban.edit',compact('beban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beban $beban)
    {
        $request->validate([
            'nama' => 'required',
            'besaran' => 'required',
            'masuk' => 'required|min:4|max:4',
            'akhir' => 'required|min:4|max:4|gte:masuk',
            ],
            [
                'akhir.gte' => 'Tahun Akhir Harus Lebih Besar Dari Tahun Masuk.',
            ]
        );       
        $beban->update($request->all());        
        return redirect()->route('user.beban.index')
                        ->with('success','Perubahan Data Beban Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beban $beban)
    {
        $beban->delete();         
        return redirect()->route('user.beban.index')
                        ->with('success','Hapus Data Beban Berhasil.');
    } 
}
