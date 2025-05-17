<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Periksa apakah pengguna memiliki role yang sesuai
        // Jika menggunakan kolom 'role' di tabel users
        if ($user->role !== $role) {
            abort(403, 'Unauthorized: You do not have the required role.');
        }

        // Jika menggunakan Spatie/laravel-permission (uncomment jika digunakan)
        /*
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized: You do not have the required role.');
        }
        */

        return $next($request);
    }
}