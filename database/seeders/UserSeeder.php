<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'nama_petugas' => 'admin',
                'username'     => 'admin',
                'password'     => bcrypt('admin'),
                'level'        => 'admin', 
                'telepon'        => '085777743960', 
            ],

            [
                'nama_petugas' => 'petugas',
                'username'     => 'petugas',
                'password'     => bcrypt('petugas'),
                'level'        => 'petugas',
                'telepon'        => '085342322444', 
            ],

            [
                'nama_petugas' => 'masyarakat',
                'username'     => 'masyarakat',
                'password'     => bcrypt('masyarakat'),
                'level'        => 'masyarakat',
                'telepon'        => '081212121212', 
            ]
            
        ];

     foreach ($users as $key => $value) {
        User::create($value);
     }
    }
}
