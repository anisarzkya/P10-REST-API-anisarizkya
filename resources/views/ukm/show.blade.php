@extends('layouts.app')

@section('title', $ukm->nama)

@section('content')
    <h1>{{ $ukm->nama }}</h1>

    <dl>
        <dt>Kode UKM</dt>
        <dd>{{ $ukm->kode }}</dd>

        <dt>Kategori</dt>
        <dd>{{ $ukm->kategori }}</dd>

        <dt>Tahun Berdiri</dt>
        <dd>{{ $ukm->tahun_berdiri }}</dd>
    </dl>

    <h2>Daftar Anggota</h2>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Jabatan</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>


        <tbody>
            @forelse ($ukm->anggota as $mahasiswa)
                <tr>
                    <td>
                        <a href="{{ url('/mahasiswa/' . $mahasiswa->nim) }}">
                            {{ $mahasiswa->nim }}
                        </a>
                    </td>

                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->prodi->nama }}</td>

                    <td>
                        @if ($mahasiswa->pivot->jabatan === 'ketua')
                            <x-badge warna="hijau">Ketua</x-badge>
                        @else
                            {{ ucfirst($mahasiswa->pivot->jabatan) }}
                        @endif
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($mahasiswa->pivot->bergabung_pada)->format('d/m/Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada anggota UKM.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('ukm.index') }}">Kembali ke daftar UKM</a>
    </p>
@endsection