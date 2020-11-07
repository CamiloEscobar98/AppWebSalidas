<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $usuario = \App\User::find(Auth()->user()->id);
        if ($usuario->hasAnyRoleSession($roles)) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
