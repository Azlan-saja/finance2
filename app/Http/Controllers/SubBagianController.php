<?php

namespace App\Http\Controllers;

use App\Models\SubBagian;
use Illuminate\Http\Request;

use App\Models\Bagian;

class SubBagianController extends Controller
{
  
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function index(Request $request, $id)
    {              
        $bagian = Bagian::find($id);
        if ($request->sort && $request->order){
            $subbagian = $bagian->subbagians()->orderBy($request->sort, $request->order)->paginate(5);
        }else{
            $subbagian = $bagian->subbagians()->latest()->paginate(5);         
        }
        return view('yys.subbagian.index',compact('bagian','subbagian','id'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);            
    }

     public function cari(Request $request, $id)
    {              
        $request->validate([
                'cari' => 'required',
        ]);      
        $bagian = Bagian::find($id);
        $subbagian = $bagian->subbagians()->where('subbagian','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
         return view('yys.subbagian.index',compact('bagian','subbagian','id'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bagian = Bagian::find($id);
        return view('yys.subbagian.create',compact('bagian','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'subbagian' => 'required',
        ]);        
        SubBagian::create([
            'bagian_id' => $id,
            'subbagian' => $request->subbagian
        ]);         
        return redirect()->route('subbagian.index', $id)
                        ->with('success','Tambah Data Sub Bagian Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubBagian $subBagian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $subbagian)
    {
        $subBagian = SubBagian::find($subbagian);
        return view('yys.subbagian.edit',compact('subBagian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request, $subBagian)
    {
        // return [$id, $request->all(), $subBagian];
        $request->validate([
            'subbagian' => 'required',
        ]);        
        SubBagian::where('id', $subBagian)
            ->update([
                'subbagian' => $request->subbagian,
        ]);        
        return redirect()->route('subbagian.index', $id)
                        ->with('success','Perubahan Data Sub Bagian Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request, $subBagian)
    {
        $subbagian = SubBagian::find($subBagian);
        $subbagian->delete();         
        return redirect()->route('subbagian.index', $id)
                        ->with('success','Hapus Data Sub Bagian Berhasil.');
    }
}
