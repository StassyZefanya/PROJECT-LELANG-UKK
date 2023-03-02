<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class logincontroller extends Controller

{
    public function view()
    {
        return view('auth.login');
    }

    public function proses(Request $request)
    {
        $user = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        
        if (Auth::attempt($user))
        {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 'admin')
            {
                return redirect()->route('dashboard.admin');
            } else if ($user->level == 'petugas') {
                return redirect()->route('dashboard.petugas');
                // return redirect()->intended('home');
            } else if ($user->level == 'masyarakat') {
                return redirect()->route('dashboard.masyarakat');
                // return redirect()->intended('/masyarakat/home');
            } else return redirect()->route('login');
        }

        return back()->withErrors([
            'username'=>'username yang anda masukkan salah!',
            'password'=>'password yang anda masukkan salah!'
        ])->onlyInput('username');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


}
