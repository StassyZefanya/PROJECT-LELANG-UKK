<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function view()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'nama_petugas' => 'required|min:3|max:25',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:3',
            'telepon' => 'required|numeric',
        ], 
        [
            'nama_petugas' => 'Nama tidak boleh kosong',
            'nama_petugas' => 'Nama minimal 3 karakter',
            'nama_petugas' => 'Nama maksimal 25 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'telepon.numeric' => 'Telepon harus berupa angka',
        ]
    );

        User::create([
            'nama_petugas' => Str::camel($data['nama_petugas']),
            'username' => Str::lower($data['username']),
            'password' => bcrypt($data['password']),
            'level' => 'masyarakat',
            'telepon' => $data['telepon'],
        ]);
        return redirect('/login');
    }
}