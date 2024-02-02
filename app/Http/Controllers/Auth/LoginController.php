<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): RedirectResponse
    {   
        $input = $request->all();
    //  return $input;
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'RA') {
                return redirect()->route('RA.home');
            }else if (auth()->user()->type == 'SD') {
                return redirect()->route('SD.home');
            }else if (auth()->user()->type == 'SMP') {
                return redirect()->route('SMP.home');
            }else if (auth()->user()->type == 'YYS') {
                return redirect()->route('YYS.home');
            }else{
                // return redirect()->route('login');
                 return redirect()->route('login')
                ->with('error','Email dan Password anda salah.');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email dan Password anda salah.');
        }          
    }
}
