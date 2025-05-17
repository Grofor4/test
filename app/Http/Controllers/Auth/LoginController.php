<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    protected $redirectTo = '/home';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Debug: cek user
        // dd(\App\Models\User::where('email', $credentials['email'])->first());

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->jabatan === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->jabatan === 'apoteker') {
                return redirect()->intended('/apoteker/dashboard');
            } elseif ($user->jabatan === 'kasir') {
                return redirect()->intended('/kasir/dashboard');
            } elseif ($user->jabatan === 'pemilik') {
                return redirect()->intended('/pemilik/dashboard');
            } elseif ($user->jabatan === 'kurir') {
                return redirect()->intended('/kurir/dashboard');
            } elseif ($user->jabatan === 'karyawan') {
                return redirect()->intended('/karyawan/dashboard');
            } else {
                return redirect()->intended($this->redirectTo);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
