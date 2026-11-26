<?php

namespace App\Http\Controllers;

class KantinController extends Controller
{
    private function dataMenu()
    {
        return [
            [
                'nama' => 'Nasi Goreng Spesial',
                'kategori' => 'Makanan',
                'harga' => 18000,
                'stok' => 12,
            ],
            [
                'nama' => 'Mie Ayam Bakso',
                'kategori' => 'Makanan',
                'harga' => 15000,
                'stok' => 0,
            ],
            [
                'nama' => 'Es Teh Manis',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'stok' => 40,
            ],
            [
                'nama' => 'Kopi Susu Gula Aren',
                'kategori' => 'Minuman',
                'harga' => 14000,
                'stok' => 3,
            ],
            [
                'nama' => 'Pisang Goreng Keju',
                'kategori' => 'Camilan',
                'harga' => 10000,
                'stok' => 8,
            ],
            [
                'nama' => 'Roti Bakar <b>Coklat</b>',
                'kategori' => 'Camilan',
                'harga' => 12000,
                'stok' => 0,
            ],
        ];
    }

    
public function index()
{
    $menu = $this->dataMenu();

    $jumlahMenu = count($menu);

    $jumlahHabis = count(array_filter($menu, function ($item) {
        return $item['stok'] === 0;
    }));

    return view('kantin.index', compact(
        'menu',
        'jumlahMenu',
        'jumlahHabis'
    ));
}


    public function tentang()
    {
        return view('kantin.tentang');
    }
}
