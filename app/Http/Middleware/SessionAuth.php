<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Redirect;

class SessionAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {      
        
        if( !session()->get($request->uri) ){
            
            return redirect('login');
        }       
        
        return Redirect::to( session()->get($request->id_system)['link'] );

        // return $next($request);
        
    }
}
