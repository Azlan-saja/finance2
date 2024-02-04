<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// use Auth;

class UserAccess
{
    
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }


        // if(auth()->user()->type == $userType){
        //     return $next($request);
        // }
       
        // printf($userType.'<br><br>');       
        $allowedUserTypes = explode('|', $userType);
        // print_r($allowedUserTypes);       
        
        if (in_array(auth()->user()->type, $allowedUserTypes)) {
            return $next($request);
        }


        return response()->view('errors.check-permission'); 
    }
}
