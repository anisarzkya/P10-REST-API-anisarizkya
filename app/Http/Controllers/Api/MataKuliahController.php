<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data = MataKuliah::with('dosen')
            ->withCount('mahasiswa')
            ->orderBy('kode')
            ->get();

        return MataKuliahResource::collection($data);
    }

    public function show(MataKuliah $matkul)
    {
        $matkul->load('dosen')->loadCount('mahasiswa');

        return new MataKuliahResource($matkul);
    }

    public function store(StoreMataKuliahRequest $request)
    {
        $matkul = MataKuliah::create($request->validated());
        $matkul->load('dosen')->loadCount('mahasiswa');

        return (new MataKuliahResource($matkul))
            ->response()
            ->setStatusCode(201)
            ->header('Location', url('/api/matkul/' . $matkul->kode));
    }
}