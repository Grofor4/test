<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'admin',
            ],
            [
                'name' => 'Apoteker User',
                'email' => 'apoteker@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'apoteker',
            ],
            [
                'name' => 'Karyawan User',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'karyawan',
            ],
            [
                'name' => 'Kasir User',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'kasir',
            ],
            [
                'name' => 'Pemilik User',
                'email' => 'pemilik@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'pemilik',
            ],
            [
                'name' => 'Kurir User',
                'email' => 'kurir@gmail.com',
                'password' => Hash::make('password123'),
                'jabatan' => 'kurir',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}