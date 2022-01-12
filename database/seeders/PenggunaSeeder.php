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
        $pengguna = new Pengguna;
        $pengguna->nama_pengguna = 'Mr. Owner';
        $pengguna->username = 'owner';
        $pengguna->password = MyAuth::hash('default');
        $pengguna->jabatan = 'pemilik';
        $pengguna->save();
    }
}
