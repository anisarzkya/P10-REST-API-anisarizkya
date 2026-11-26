
@extends('layouts.kantin')

@section('title', 'Katalog Menu')

@section('content')
    <h1>Katalog Kantin Kampus</h1>

    <p>Jumlah menu: {{ $jumlahMenu }}</p>
    <p>Menu habis: {{ $jumlahHabis }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($menu as $item)
                <tr @class(['stok-habis' => $item['stok'] === 0])>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>
                        @if ($item['stok'] === 0)
                            <x-badge warna="merah">Habis</x-badge>
                        @elseif ($item['stok'] <= 5)
                            <x-badge warna="kuning">
                                Tersisa {{ $item['stok'] }}
                            </x-badge>
                        @else
                            <x-badge warna="hijau">Tersedia</x-badge>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
