@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<section class="content-header">
    <h1>Pasien <small>Riwayat Pemeriksaan</small></h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Riwayat Pemeriksaan</h3>
        </div>
        <div class="card-body">
            @if($periksas->isEmpty())
                <p>Tidak ada riwayat pemeriksaan.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th width="5%">NO</th>
                            <th>ID Periksa</th>
                            <th>Tanggal Periksa</th>
                            <th>Catatan</th>
                            <th>Diagnosa</th>
                            <th>Biaya Periksa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periksas as $index => $periksa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $periksa->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                            <td>{{ $periksa->catatan }}</td>
                            <td>{{ $periksa->diagnosa ?? 'Belum ada diagnosa' }}</td>
                            <td>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</section>
@endsection