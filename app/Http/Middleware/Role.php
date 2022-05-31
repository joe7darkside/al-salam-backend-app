<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role, $superAdmin)
    {
        $adminRole = auth()->user()->role;


        if ($adminRole == $role || $adminRole == $superAdmin) {

            return $next($request);
        }

        return redirect()->back()->with('error', "You don't have access.");
    }
}
