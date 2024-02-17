<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pemasukan;
use App\Models\Anggaran;
use Illuminate\Support\Facades\Auth;

class UserPemasukanController extends Controller
{
       public function __construct()
    {
        $this->middleware(['auth', 'user-access:RA|SD|SMP']);
    }
    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $pemasukan = Pemasukan::where('unit',Auth::User()->lvl)
                ->orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $pemasukan = Pemasukan::where('unit',Auth::User()->lvl)
                ->latest()->paginate(5);         
        }
        return view('user.pemasukan.index',compact('pemasukan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);        
        // $xunit = 5;
        // if (strtolower($request->cari) == 'yys') $xunit = 3;
        // if (strtolower($request->cari) == 'smp') $xunit = 2;
        // if (strtolower($request->cari) == 'sd') $xunit = 1;
        // if (strtolower($request->cari) == 'ra') $xunit = 0; 
        // if($xunit <=3){
        //     $pemasukan = Pemasukan::Where('unit','like','%'.$xunit.'%')            
        //         ->latest()->paginate(5);    
        // }else{
            $pemasukan = Pemasukan::where('unit',Auth::User()->lvl)
                ->where('nama','like','%'.$request->cari.'%')
                ->orWhere('sumber','like','%'.$request->cari.'%')            
                ->orWhere('nominal','like','%'.$request->cari.'%')            
                ->orWhere('tanggal','like','%'.$request->cari.'%')            
                ->orWhere('tahun','like','%'.$request->cari.'%')            
                ->orWhere('unit','like','%'.$request->cari.'%')            
                ->latest()->paginate(5);    
        // }
                      
        return view('user.pemasukan.index',compact('pemasukan'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    public function create()
    {
        $sumberanggaran = anggaran::orderBy('anggaran', 'asc')->get();
        return view('user.pemasukan.create',compact('sumberanggaran'));
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

        Pemasukan::create([
             'nama' => $request->nama,
            'sumber' => $request->sumber,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'tahun' => $request->tahun,
            'unit' => Auth::User()->lvl,
        ]);         
        return redirect()->route('user.pemasukan.index')
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
        $pemasukan = Pemasukan::where('unit',Auth::User()->lvl)
                ->where('id', $pemasukan->id)->first();  
        if ($pemasukan){
            $sumberanggaran = anggaran::orderBy('anggaran', 'asc')->get();
            return view('user.pemasukan.edit',compact('pemasukan','sumberanggaran'));
        }else{
            return response()->view('errors.check-permission'); 
        }              
       
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
        return redirect()->route('user.pemasukan.index')
                        ->with('success','Perubahan Data Pemasukan Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();         
        return redirect()->route('user.pemasukan.index')
                        ->with('success','Hapus Data Pemasukan Berhasil.');
    }
}
