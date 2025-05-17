<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->jabatan !== $role) {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }
        return $next($request);
    }
}
