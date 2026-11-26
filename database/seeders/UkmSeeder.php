<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ukm;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UkmSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Bersihkan data UKM dan pivot lama
            DB::table('keanggotaan')->delete();
            Ukm::query()->delete();

            // Data UKM
            $data = [
                ['UKM-01', 'Robotika dan IoT', 'Akademik', 2018],
                ['UKM-02', 'Paduan Suara Mahasiswa', 'Seni', 2015],
                ['UKM-03', 'Futsal', 'Olahraga', 2012],
                ['UKM-04', 'Basket', 'Olahraga', 2013],
                ['UKM-05', 'Kewirausahaan', 'Akademik', 2019],
                ['UKM-06', 'Teater Kampus', 'Seni', 2016],
                ['UKM-07', 'Bakti Sosial', 'Sosial', 2014],
                ['UKM-08', 'Fotografi dan Film', 'Seni', 2017],
            ];

            foreach ($data as $item) {
                Ukm::create([
                    'kode' => $item[0],
                    'nama' => $item[1],
                    'kategori' => $item[2],
                    'tahun_berdiri' => $item[3],
                ]);
            }

            // Membuat keanggotaan mahasiswa
            $mahasiswa = Mahasiswa::orderBy('id')->get();

            foreach ($mahasiswa as $m) {

                $n = (int) $m->id;

                $nomorUkm = [
                    (($n - 1) % 8) + 1
                ];

                if ($n % 3 != 0) {
                    $nomorUkm[] = (($n * 3) % 8) + 1;
                }

                if ($n % 5 == 0) {
                    $nomorUkm[] = (($n * 5) % 8) + 1;
                }

                $nomorUkm = array_unique($nomorUkm);

                $tanggal = Carbon::parse('2024-09-01')
                    ->addDays($n * 7)
                    ->toDateString();

                foreach ($nomorUkm as $nomor) {

                    $ukm = Ukm::where(
                        'kode',
                        sprintf('UKM-%02d', $nomor)
                    )->firstOrFail();

                    $ketua = (($n - 1) % 8) + 1;

                    $jabatan = ($n <= 8 && $nomor == $ketua)
                        ? 'ketua'
                        : 'anggota';

                    $m->ukm()->attach($ukm->id, [
                        'jabatan' => $jabatan,
                        'bergabung_pada' => $tanggal,
                    ]);
                }
            }
        });
    }
}