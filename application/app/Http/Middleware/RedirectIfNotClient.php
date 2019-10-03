<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'client')
    {
        
        if (!Auth::guard($guard)->check()){
            return redirect('/')->with([
                'message'=> language_data('Invalid Access'),
                'message_important'=>true
            ]);
        }elseif(Auth::guard($guard)->user()->status=='Inactive'){
            Auth::guard('client')->logout();
            //return redirect('user/registration-verification');
            //Auth::logout();
            /*return redirect('user/registration-verification')->with([
                    'message' => language_data('Something wrong, Please contact with your provider'),
                    'message_important' => true
                ]);*/
            return redirect('user/login-deactive');
        }
        return $next($request);
    }
}
