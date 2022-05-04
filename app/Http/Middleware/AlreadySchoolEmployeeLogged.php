<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadySchoolEmployeeLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('LoggedSchoolEmployee') && ($request->path() == 'schoolemployee/login')){
            return redirect('schoolemployee/home');
        }
        return $next($request);
    }
}
