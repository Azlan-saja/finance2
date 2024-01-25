<?php

namespace App\Http\Controllers;

use App\Models\Rencana;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class RencanaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }
    public function index(Request $request)
    {                  
        if ($request->sort && $request->order){
            $rencana = Rencana::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $rencana = Rencana::latest()->paginate(5);         
        }
        return view('yys.rencana.index',compact('rencana'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);       
    }
 
    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        $rencana = Rencana::orWhere('anggaran','like','%'.$request->cari.'%')
                 ->orWhere('tahun','like','%'.$request->cari.'%')             
                 ->orWhere('unit','like','%'.$request->cari.'%')             
                 ->orWhere('status','like','%'.$request->cari.'%')             
                 ->latest()->paginate(5);                  
        return view('yys.rencana.index',compact('rencana'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('yys.rencana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
            
        $request->validate([
            'anggaran' => 'required',
            'unit' => 'required|numeric',
            'tahun' => 'required|max:9',
        ],
        [
            'unit.numeric' => 'The unit field is wrong.',
        ]);             
        
        $cek = Rencana::where('unit',$request->unit)->where('tahun',$request->tahun)->first();
        // return $cek;
        if ($cek){
            return redirect()->back()->withInput()
                        ->with('error','Gagal Tambah Rencana Anggaran Belanja - RAB Karena Unit dan Tahun Yang Dipilih Sudah Pernah Disimpan.');
        }

        $data = [
            'anggaran' => str_replace('.','',$request->anggaran),
            'unit' => $request->unit,
            'tahun' => $request->tahun,            
            'status' => 'Open',
            
        ];
        Rencana::create($data);         
        return redirect()->route('rencana.index')
                        ->with('success','Tambah Data Rencana Anggaran Belanja - RAB Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(rencana $rencana)
    {
        return view('yys.rencana.show',compact('rencana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rencana $rencana)
    {
        return view('yys.rencana.edit',compact('rencana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rencana $rencana)
    {
         
        $request->validate([
            'anggaran' => 'required',
            'unit' => 'required|numeric',
            'tahun' => 'required|max:9',
        ],
        [
            'unit.numeric' => 'The unit field is wrong.',
        ]);   
        
        $data = [
            'anggaran' => str_replace('.','',$request->anggaran),
            'unit' => $request->unit,
            'tahun' => $request->tahun,
        ];
        $rencana->update($data);        
        return redirect()->route('rencana.index')
                        ->with('success','Perubahan Data Rencana Anggaran Belanja - RAB Berhasil Disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rencana $rencana)
    {        
        $rencana->delete();         
        return redirect()->route('rencana.index')
                        ->with('success','Hapus Data Rencana Anggaran Belanja - RAB Berhasil.');
    }
    
    public function closed(rencana $rencana)
    {
        // $rencana = Rencana::find($id);
        // return $rencana;
        if ($rencana->status == 'Closed'){
            $rencana->update(['status' => 'Open']);  
            return redirect()->route('rencana.index')
                        ->with('success','Data Rencana Anggaran Belanja - RAB Berhasil di Open.');
        }else{
            $rencana->update(['status' => 'Closed']);  
            return redirect()->route('rencana.index')
                        ->with('success','Data Rencana Anggaran Belanja - RAB Berhasil di Closed.');
        }

    }

  


}
