<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $anggaran = anggaran::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $anggaran = anggaran::latest()->paginate(5);         
        }
        return view('yys.anggaran.index',compact('anggaran'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $anggaran = anggaran::where('anggaran','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
        return view('yys.anggaran.index',compact('anggaran'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
         return view('yys.anggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggaran' => 'required',
        ]);        
        anggaran::create($request->all());         
        return redirect()->route('anggaran.index')
                        ->with('success','Tambah Data anggaran Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(anggaran $anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(anggaran $anggaran)
    {
        return view('yys.anggaran.edit',compact('anggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, anggaran $anggaran)
    {
        $request->validate([
            'anggaran' => 'required',
        ]);        
        $anggaran->update($request->all());        
        return redirect()->route('anggaran.index')
                        ->with('success','Perubahan Data anggaran Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(anggaran $anggaran)
    {
        $anggaran->delete();         
        return redirect()->route('anggaran.index')
                        ->with('success','Hapus Data anggaran Berhasil.');
    }
}
