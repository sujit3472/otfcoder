<?php
namespace App\Http\Middleware;

use Auth;
use Flash;
use Closure;
use Illuminate\Http\Request;

class CheckUserAccess
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
        if(Auth::check() && !empty(Auth::user()->email_confirmation) || Auth::user()->status != '1') {
            Auth::logout();
            Flash::error("Your account is not activated or email is not verified")->important();
            return redirect('/login');
        }
        
        if(Auth::check())  {
            $user_role = Auth::user()->role_id; 
            if($user_role == 2){
                return $next($request);
            } 
            ## if user is other than the admin, then give the forbidden access 
            return redirect('/user-home');
        } else {
            //flash('You are not logged in')->error();
            return redirect('login');
        }
    }
}
