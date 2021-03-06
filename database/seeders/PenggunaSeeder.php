<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Helpers\MyAuth;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengguna::create([
            'nama_pengguna' => 'Bapak Pemilik',
            'username' => 'pemilik',
            'email' => 'pemilik@example.com',
            'password' => MyAuth::hash('default'),
            'jabatan' => 'pemilik',
        ]);

        Pengguna::create([
            'nama_pengguna' => 'Ibu Kasir',
            'username' => 'kasir',
            'email' => 'kasir@example.com',
            'password' => MyAuth::hash('default'),
            'jabatan' => 'kasir',
        ]);
    }
}
