<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Set session
            session([
                'user_id' => $user->id,
                'user_name' => $user->name
            ]);

            // Set cookie last_login (60 menit)
            $cookie = cookie('last_login', now()->format('d M Y, H:i:s'), 60);

            return redirect('/dashboard')->withCookie($cookie);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Dashboard
    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login');
        }

        return view('auth.dashboard', [
            'name' => session('user_name'),
            'last_login' => cookie('last_login')
        ]);
    }

    // Logout
    public function logout()
    {
        session()->flush();
        $cookie = cookie()->forget('last_login');
        return redirect('/login')->with('success', 'Logout berhasil.')->withCookie($cookie);
    }
}
