<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('prodi')->orderBy('nim')->paginate(10);

        return MahasiswaResource::collection($mahasiswas);
    }

    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::create($request->validated())->fresh();

        return (new MahasiswaResource($mahasiswa->load('prodi')))
            ->response()
            ->setStatusCode(201)
            ->header('Location', url('/api/mahasiswa/' . $mahasiswa->nim));
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load(['prodi', 'dosenWali', 'mataKuliah']);

        return new MahasiswaResource($mahasiswa);
    }

    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());

        return new MahasiswaResource($mahasiswa->load('prodi'));
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->noContent();
    }
}