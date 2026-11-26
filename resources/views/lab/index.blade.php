@extends('layouts.app')

@section('title', 'Inventaris Lab')

@section('content')
    <h1>Inventaris Lab Komputer</h1>
    
    

<div class="ringkasan-lab">
    <div class="kartu-lab">
        <small>Jenis alat</small>
        <strong>{{ $jumlahJenis }}</strong>
    </div>

    <div class="kartu-lab">
        <small>Total unit</small>
        <strong>{{ $totalUnit }}</strong>
    </div>

    <div class="kartu-lab">
        <small>Nilai aset</small>
        <strong>Rp{{ number_format($nilaiAset, 0, ',', '.') }}</strong>
    </div>

    <div class="kartu-lab">
        <small>Rata-rata harga</small>
        <strong>Rp{{ number_format($rataRataHarga, 0, ',', '.') }}</strong>
    </div>
</div>

<p class="info-lab">
    Alat termahal:
    <strong>{{ $alatTermahal->nama }}</strong>
    (Rp{{ number_format($alatTermahal->harga, 0, ',', '.') }}).
    Per kondisi:
    @foreach (['baik', 'perbaikan', 'rusak'] as $kondisi)
        {{ $kondisi }} {{ $jumlahPerKondisi[$kondisi] ?? 0 }}@if (!$loop->last), @endif
    @endforeach.
</p>



    <form class="cari" method="GET" action="/lab">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari nama alat..."
        >

        <select name="kategori">
            <option value="">Semua kategori</option>
            @foreach ($kategoris as $kategori)
                <option
                    value="{{ $kategori }}"
                    @selected(request('kategori') == $kategori)
                >
                    {{ $kategori }}
                </option>
            @endforeach
        </select>

        <select name="kondisi">
            <option value="">Semua kondisi</option>
            <option value="baik" @selected(request('kondisi') == 'baik')>Baik</option>
            <option value="perbaikan" @selected(request('kondisi') == 'perbaikan')>Perbaikan</option>
            <option value="rusak" @selected(request('kondisi') == 'rusak')>Rusak</option>
        </select>

        <button type="submit">Filter</button>
        <a href="/lab">Reset</a>
    </form>

    <p>Menampilkan {{ $alats->count() }} alat.</p>

    <table class="tabel-lab">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Harga</th>
                <th>Tanggal beli</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($alats as $alat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alat->kode }}</td>
                    <td>{{ $alat->nama }}</td>
                    <td>{{ $alat->kategori }}</td>
                    <td>{{ $alat->jumlah }}</td>
                    <td>
                        <x-badge :kondisi="$alat->kondisi" />
                    </td>
                    <td>Rp{{ number_format($alat->harga, 0, ',', '.') }}</td>
                    <td>{{ $alat->tanggal_beli->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada alat yang cocok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
