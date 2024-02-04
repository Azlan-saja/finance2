<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPenggunaController extends Controller
{
    public function __construct()
    {      
        $this->middleware(['auth','user-access:RA|SD|SMP']);                
    }

     public function saya()
    {
       return view('user.pengguna.ubah-password');
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

        return redirect()->route('user.pengguna-aktif.saya')
                        ->with('success','Perubahan Password Baru Berhasil Disimpan.');
    }

    public function akun()
    {        
        return view('user.pengguna.ubah-akun');
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
        return redirect()->route('user.pengguna-aktif.akun')
                        ->with('success','Perubahan Akun Berhasil Disimpan.');
    }
}
