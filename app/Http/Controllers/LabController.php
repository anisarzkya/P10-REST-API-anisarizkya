<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::query();

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        $alats = $query->orderBy('kode')->get();

        $kategoris = Alat::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        // Ringkasan seluruh inventaris, tidak terpengaruh filter.
        $jumlahJenis = Alat::count();
        $totalUnit = Alat::sum('jumlah');

        $nilaiAset = Alat::selectRaw(
            'SUM(jumlah * harga) as total'
        )->value('total') ?? 0;

        $rataRataHarga = Alat::avg('harga') ?? 0;

        $alatTermahal = Alat::orderByDesc('harga')->first();

        $jumlahPerKondisi = Alat::select('kondisi')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupBy('kondisi')
            ->pluck('jumlah', 'kondisi');

        return view('lab.index', compact(
            'alats',
            'kategoris',
            'jumlahJenis',
            'totalUnit',
            'nilaiAset',
            'rataRataHarga',
            'alatTermahal',
            'jumlahPerKondisi'
        ));
    }
    public function show(Alat $alat)
{
    return view('lab.show', compact('alat'));
}
}
