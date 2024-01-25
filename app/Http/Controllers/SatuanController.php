<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $satuan = satuan::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $satuan = satuan::latest()->paginate(5);         
        }
        return view('yys.satuan.index',compact('satuan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $satuan = satuan::where('satuan','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
        return view('yys.satuan.index',compact('satuan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
         return view('yys.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required',
        ]);        
        satuan::create($request->all());         
        return redirect()->route('satuan.index')
                        ->with('success','Tambah Data satuan Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(satuan $satuan)
    {
        return view('yys.satuan.edit',compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, satuan $satuan)
    {
        $request->validate([
            'satuan' => 'required',
        ]);        
        $satuan->update($request->all());        
        return redirect()->route('satuan.index')
                        ->with('success','Perubahan Data satuan Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(satuan $satuan)
    {
        $satuan->delete();         
        return redirect()->route('satuan.index')
                        ->with('success','Hapus Data satuan Berhasil.');
    }
}
