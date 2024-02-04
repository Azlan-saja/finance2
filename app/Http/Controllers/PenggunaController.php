<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    
   public function __construct()
    {      
        $this->middleware([
            'auth',
            'user-access:YYS',
        ]);                
    }
    public function index(Request $request)
    {
        if ($request->sort && $request->order){
            $pengguna = User::orderBy($request->sort, $request->order)->paginate(5);  
        }else{
            $pengguna = User::latest()->paginate(5);         
        }
        return view('yys.pengguna.index',compact('pengguna'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);     
    }

    public function create()
    {        
        return view('yys.pengguna.create');
    }


    public function cari(Request $request)
    {              
        $request->validate([
                'cari' => 'required',
        ]);       
        if (strtolower($request->cari) == 'yys') $request->cari = 3;
        if (strtolower($request->cari) == 'smp') $request->cari = 2;
        if (strtolower($request->cari) == 'sd') $request->cari = 1;
        if (strtolower($request->cari) == 'ra') $request->cari = 0; 
        $pengguna = User::where('name','like','%'.$request->cari.'%')
                ->orWhere('email','like','%'.$request->cari.'%')            
                ->orWhere('type','like','%'.$request->cari.'%')            
                ->latest()->paginate(5);                  
        return view('yys.pengguna.index',compact('pengguna'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);      
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'type' => 'required|numeric',
            ],
            [
                'type.numeric' => 'Unit tidak terdaftar.',                
            ]
        );   
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make('12345678'),
        ]);
        return redirect()->route('pengguna.index')
                        ->with('success','Tambah Data Pengguna Berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pengguna)
    {  
        return view('yys.pengguna.edit',compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $pengguna)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users,email,'.$pengguna->id,
            'type' => 'required|numeric',
            ],
            [
                'type.numeric' => 'Unit tidak terdaftar.',                
            ]
        );   
        $pengguna->update([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
        ]);        
        return redirect()->route('pengguna.index')
                        ->with('success','Perubahan Data Pengguna Berhasil Disimpan.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();         
        return redirect()->route('pengguna.index')
                        ->with('success','Hapus Data Pengguna Berhasil.');
    }
   
    public function reset(User $pengguna)
    {
        $pengguna->update([
            'password' => Hash::make('12345678'),
        ]);  
        return redirect()->route('pengguna.index')
                        ->with('success','Reset Password Dengan Email '.$pengguna->email.' Telah Berhasil.');
        
    }
    


    public function saya()
    {
       return view('yys.pengguna.ubah-password');
    }

    public function ubah_saya(Request $request)
    {
        $request->validate([
            'password_baru' => 'required|min:8',
            'ulangi_password_baru'=> 'required|min:8|required_with:password_baru|same:password_baru',            
            ]
        );   

        $pengguna = User::find(Auth::User()->id);
        $pengguna->password = Hash::make($request->ulangi_password_baru);
        $pengguna->save();

        return redirect()->route('pengguna-aktif.saya')
                        ->with('success','Perubahan Password Baru Berhasil Disimpan.');
    }

    public function akun()
    {        
        return view('yys.pengguna.ubah-akun');
    }

    public function ubah_akun(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email'=> 'required|email|unique:users,email,'.Auth::User()->id,            
            ]
        );   

        $pengguna = User::find(Auth::User()->id);
        $pengguna->name = $request->nama;
        $pengguna->email = $request->email;
        $pengguna->save();
        return redirect()->route('pengguna-aktif.akun')
                        ->with('success','Perubahan Akun Berhasil Disimpan.');
    }

    



}
