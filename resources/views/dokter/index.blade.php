@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<section class="content-header">
    <h1>Dokter <small>Dashboard</small></h1>
</section>

<section class="content">
    {{-- Ringkasan Pemeriksaan Terbaru --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Ringkasan Pemeriksaan Terbaru</h3>
        </div>
        <div class="card-body">
            @if($latestPeriksa)
                <p><strong>ID Pemeriksaan:</strong> {{ $latestPeriksa->id }}</p>
                <p><strong>Nama Pasien:</strong> {{ $latestPeriksa->pasien->name ?? 'Tidak diketahui' }}</p>
                <p><strong>Tanggal Periksa:</strong> {{ \Carbon\Carbon::parse($latestPeriksa->tgl_periksa)->format('d-m-Y') }}</p>
                <p><strong>Catatan:</strong> {{ $latestPeriksa->catatan }}</p>
                <p><strong>Diagnosa:</strong> {{ $latestPeriksa->diagnosa ?? 'Belum ada diagnosa' }}</p>
            @else
                <p>Belum ada pemeriksaan tercatat.</p>
            @endif
        </div>
    </div>

    {{-- Riwayat Pemeriksaan --}}
    <div class="card mt-3">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title">Riwayat Pemeriksaan</h3>
        </div>
        <div class="card-body">
            @if($periksas->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periksas as $index => $periksa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $periksa->pasien->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                                <td>{{ $periksa->diagnosa ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('dokter.periksa.show', $periksa->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada riwayat pemeriksaan.</p>
            @endif
        </div>
    </div>

    {{-- Tombol Tambah Pemeriksaan --}}
    <div class="card mt-3">
        <div class="card-header bg-success text-white">
            <h3 class="card-title">Tambah Pemeriksaan Baru</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('dokter.periksa.create') }}" class="btn btn-success">Tambah Pemeriksaan</a>
        </div>
    </div>
</section>
@endsection
