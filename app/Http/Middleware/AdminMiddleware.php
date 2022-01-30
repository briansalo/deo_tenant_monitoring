<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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

        if(Auth::user()->email=='briansalo1997@gmail.com' or Auth::user()->email=='admin@gmail.com'){
                    return $next($request);            
        }
        else{

             $notification = array(
                 'message' => 'This current user is not authorize for this function!!!',
                 'alert-type' => 'error'  //error variable came from admin.blade.php in java script toastr
             );

             return back()->with($notification);
        }

    }
}
