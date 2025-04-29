@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<section class="content-header">
    <h1>Pasien <small>Dashboard</small></h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Ringkasan Pemeriksaan Terbaru</h3>
        </div>
        <div class="card-body">
            @if($latestPeriksa)
                <p><strong>ID Pemeriksaan:</strong> {{ $latestPeriksa->id }}</p>
                <p><strong>Tanggal Periksa:</strong> {{ \Carbon\Carbon::parse($latestPeriksa->tgl_periksa)->format('d-m-Y') }}</p>
                <p><strong>Catatan:</strong> {{ $latestPeriksa->catatan }}</p>
                <p><strong>Diagnosa:</strong> {{ $latestPeriksa->diagnosa ?? 'Belum ada diagnosa' }}</p>
                <p><strong>Biaya Periksa:</strong> Rp {{ number_format($latestPeriksa->biaya_periksa, 0, ',', '.') }}</p>
            @else
                <p>Belum ada pemeriksaan yang tercatat.</p>
            @endif
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title">Riwayat Pemeriksaan</h3>
        </div>
        <div class="card-body">
            @if($periksas->count() > 0)
                <a href="{{ route('pasien.riwayat.index') }}" class="btn btn-info">Lihat Riwayat Pemeriksaan</a>
            @else
                <p>Tidak ada riwayat pemeriksaan.</p>
            @endif
        </div>
    </div>
</section>
@endsection