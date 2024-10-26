<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->role_id == 2) {
                return redirect()->route('produksi.dashboard');
            } elseif (auth()->user()->role_id == 3) {
                return redirect()->route('kasir.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
