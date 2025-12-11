<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Menampilkan formulir login admin.
     * INI ADALAH METHOD YANG HILANG/ERROR.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Tangani permintaan login yang masuk.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // 1. Verifikasi Kredensial dan Role
        if ($user && Auth::attempt($credentials, $request->boolean('remember'))) {
            // Cek apakah user memiliki role 'admin'
            if ($user->role !== 'admin') {
                Auth::logout(); // Logout jika bukan admin
                return back()->with('error', 'Akses ditolak. Hanya akun Admin yang dapat masuk.');
            }
            
            $request->session()->regenerate();
            
            // Redirect ke dashboard admin
            return redirect()->intended(route('admin.dashboard')); 
        }

        // Jika kredensial salah
        return back()->with('error', 'Email atau Password salah. Silakan coba lagi.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))->with('status', 'Anda telah berhasil logout.');
    }
}