<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'Tuấn Anh',
            'username' => 'tuanh66',
            'phone' => '0702775297',
            'email' => 'tnquanganh@gmail.com',
            'password' => Hash::make('Ba10031966@'), // mã hóa password
            'role' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
