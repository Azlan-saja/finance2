<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

use App\Models\Anggaran;

class PemasukanController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }
    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $pemasukan = Pemasukan::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $pemasukan = Pemasukan::latest()->paginate(5);         
        }
        return view('yys.pemasukan.index',compact('pemasukan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $pemasukan = Pemasukan::where('nama','like','%'.$request->cari.'%')
                ->orWhere('sumber','like','%'.$request->cari.'%')            
                ->orWhere('nominal','like','%'.$request->cari.'%')            
                ->orWhere('tanggal','like','%'.$request->cari.'%')            
                ->orWhere('tahun','like','%'.$request->cari.'%')            
                ->latest()->paginate(5);                  
        return view('yys.pemasukan.index',compact('pemasukan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
        $sumberanggaran = anggaran::orderBy('anggaran', 'asc')->get();
        return view('yys.pemasukan.create',compact('sumberanggaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'sumber' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
            'tahun' => 'required',
        ]);   
        
        Pemasukan::create($request->all());         
        return redirect()->route('pemasukan.index')
                        ->with('success','Tambah Data Pemasukan Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        $sumberanggaran = anggaran::orderBy('anggaran', 'asc')->get();
        return view('yys.pemasukan.edit',compact('pemasukan','sumberanggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        $request->validate([
            'nama' => 'required',
            'sumber' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required',
            'tahun' => 'required',
        ]);         
        $pemasukan->update($request->all());        
        return redirect()->route('pemasukan.index')
                        ->with('success','Perubahan Data Pemasukan Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();         
        return redirect()->route('pemasukan.index')
                        ->with('success','Hapus Data Pemasukan Berhasil.');
    }
}
