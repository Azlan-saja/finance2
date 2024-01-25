<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }
    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $kegiatan = Kegiatan::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $kegiatan = Kegiatan::latest()->paginate(5);         
        }
        return view('yys.kegiatan.index',compact('kegiatan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $kegiatan = Kegiatan::where('kegiatan','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
        return view('yys.kegiatan.index',compact('kegiatan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
         return view('yys.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
        ]);        
        Kegiatan::create($request->all());         
        return redirect()->route('kegiatan.index')
                        ->with('success','Tambah Data Kegiatan Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('yys.kegiatan.edit',compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'kegiatan' => 'required',
        ]);        
        $kegiatan->update($request->all());        
        return redirect()->route('kegiatan.index')
                        ->with('success','Perubahan Data Kegiatan Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();         
        return redirect()->route('kegiatan.index')
                        ->with('success','Hapus Data Kegiatan Berhasil.');
    }
}
