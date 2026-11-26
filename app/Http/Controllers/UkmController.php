<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $kategoris = ['Akademik', 'Seni', 'Olahraga', 'Sosial'];

        $ukms = Ukm::query()
            ->withCount('anggota')
            ->with([
                'anggota' => fn ($query) =>
                    $query->wherePivot('jabatan', 'ketua')
            ])
            ->kategori($kategori)
            ->orderBy('kode')
            ->paginate(5)
            ->withQueryString();

        return view('ukm.index', compact(
            'ukms',
            'kategori',
            'kategoris'
        ));
    }

    public function show(Ukm $ukm)
{
    $ukm->load([
        'anggota' => function ($query) {
            $query->with('prodi')
                ->orderByPivot('bergabung_pada');
        }
    ]);

    return view('ukm.show', compact('ukm'));
}
}