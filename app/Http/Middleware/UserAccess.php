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
            // return $next($request);
            $response = $next($request);
            $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');     
            return $response;
            
            
            // $response = $next($request);
            // return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            // ->header('Pragma', 'no-cache')
            // ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        }


        return response()->view('errors.check-permission'); 
    }
}
