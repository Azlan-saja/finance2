<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;

class BagianController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }
    public function index(Request $request)
    {                  
        if ($request->sort && $request->order){
            $bagian = Bagian::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $bagian = Bagian::latest()->paginate(5);         
        }
         // $bagian->setCollection($bagian->groupBy('type'));
        return view('yys.bagian.index',compact('bagian'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);       
    }
 
    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
         $bagian = Bagian::where('bagian','like','%'.$request->cari.'%')
                 ->latest()->paginate(5);                  
        return view('yys.bagian.index',compact('bagian'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('yys.bagian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bagian' => 'required',
        ]);        
        Bagian::create($request->all());         
        return redirect()->route('bagian.index')
                        ->with('success','Tambah Data Bagian Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bagian $bagian)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bagian $bagian)
    {
        return view('yys.bagian.edit',compact('bagian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bagian $bagian)
    {
       $request->validate([
            'bagian' => 'required',
        ]);        
        $bagian->update($request->all());        
        return redirect()->route('bagian.index')
                        ->with('success','Perubahan Data Bagian Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bagian $bagian)
    {
        $bagian->delete();         
        return redirect()->route('bagian.index')
                        ->with('success','Hapus Data Bagian Berhasil.');
    }
}
