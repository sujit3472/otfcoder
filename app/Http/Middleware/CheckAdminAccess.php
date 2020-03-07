<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;

class CheckAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(Auth::check())  {
            $user_role    = Auth::user()->role_id;
          
            if($user_role == 1){
                return $next($request);
            }
            ## if user is other than the admin, then give the forbidden access 
            return redirect('/forbidden');    
        } else {
            //flash('You are not logged in')->error();
            return redirect('login');
        }
    }
}
