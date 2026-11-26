@extends('layouts.app')

@section('title', $alat->nama)

@section('content')
    <h1>Detail Alat</h1>

    <dl>
        <dt>Kode</dt>
        <dd>{{ $alat->kode }}</dd>

        <dt>Nama alat</dt>
        <dd>{{ $alat->nama }}</dd>

        <dt>Kategori</dt>
        <dd>{{ $alat->kategori }}</dd>

        <dt>Jumlah unit</dt>
        <dd>{{ $alat->jumlah }}</dd>

        <dt>Kondisi</dt>
        <dd><x-badge :kondisi="$alat->kondisi" /></dd>

        <dt>Harga satuan</dt>
        <dd>Rp{{ number_format($alat->harga, 0, ',', '.') }}</dd>

        <dt>Tanggal beli</dt>
        <dd>{{ $alat->tanggal_beli->format('d/m/Y') }}</dd>
    </dl>

    <p><a href="/lab">&larr; Kembali ke inventaris</a></p>
@endsection
