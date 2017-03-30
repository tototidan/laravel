<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        $Admin=Auth::user()->IsAdmin;
        if ($Admin == 1)
        {
            return $next($request);
        }
        else
        {
            return redirect()->back()->with("danger", "Vous n'avez pas les droits administrateurs")->withInput();
        }
    }
}
