@extends('layouts.app')

@section('title', 'Unit Kegiatan Mahasiswa')

@section('content')
    <h1>Unit Kegiatan Mahasiswa</h1>

    <form method="GET" action="{{ route('ukm.index') }}">
        <select name="kategori">
            <option value="">Semua kategori</option>

            @foreach ($kategoris as $item)
                <option value="{{ $item }}"
                    @selected($kategori === $item)>
                    {{ $item }}
                </option>
            @endforeach
        </select>

        <button type="submit">Tampilkan</button>
        <a href="{{ route('ukm.index') }}">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama UKM</th>
                <th>Kategori</th>
                <th>Jumlah Anggota</th>
                <th>Ketua</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($ukms as $ukm)
                <tr>
                    <td>
                        {{ $ukm->kode }}
                    </td>
                    <td>{{ $ukm->nama }}</td>
                    <td>{{ $ukm->kategori }}</td>
                    <td>{{ $ukm->anggota_count }}</td>
                    <td>{{ $ukm->anggota->first()?->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        Tidak ada UKM pada kategori ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $ukms->links() }}
@endsection