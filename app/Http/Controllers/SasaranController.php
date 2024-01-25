<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use Illuminate\Http\Request;

class SasaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $sasaran = Sasaran::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $sasaran = Sasaran::latest()->paginate(5);         
        }
        return view('yys.sasaran.index',compact('sasaran'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $sasaran = Sasaran::where('sasaran','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
        return view('yys.sasaran.index',compact('sasaran'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
         return view('yys.sasaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sasaran' => 'required',
        ]);        
        Sasaran::create($request->all());         
        return redirect()->route('sasaran.index')
                        ->with('success','Tambah Data sasaran Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(sasaran $sasaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sasaran $sasaran)
    {
        return view('yys.sasaran.edit',compact('sasaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sasaran $sasaran)
    {
        $request->validate([
            'sasaran' => 'required',
        ]);        
        $sasaran->update($request->all());        
        return redirect()->route('sasaran.index')
                        ->with('success','Perubahan Data sasaran Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sasaran $sasaran)
    {
        $sasaran->delete();         
        return redirect()->route('sasaran.index')
                        ->with('success','Hapus Data sasaran Berhasil.');
    }
}
