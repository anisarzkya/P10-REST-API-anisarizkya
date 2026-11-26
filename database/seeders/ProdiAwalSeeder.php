<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodis')->insert([
            [
                'kode' => 'SI',
                'nama' => 'Sistem Informasi',
                'jenjang' => 'S1',
                'ketua_prodi' => 'Ketua Prodi SI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
