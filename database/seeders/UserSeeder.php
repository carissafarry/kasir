<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'kode_pengguna' => 'USR0001',
            'nama' => 'Admin',
            'email' => 'admin@site.com',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);

        User::create([
            'kode_pengguna' => 'USR0002',
            'nama' => 'Produksi',
            'email' => 'produksi@site.com',
            'password' => Hash::make('produksi'),
            'role_id' => 2,
        ]);

        User::create([
            'kode_pengguna' => 'USR0003',
            'nama' => 'Kasir',
            'email' => 'kasir@site.com',
            'password' => Hash::make('kasir'),
            'role_id' => 3,
        ]);
    }
}
