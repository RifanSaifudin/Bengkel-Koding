@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<section class="content-header">
    <h1>Dokter <small>Daftar Periksa Pasien</small></h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Data Pemeriksaan</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th width="5%">NO</th>
                        <th>ID Periksa</th>
                        <th>Pasien</th>
                        <th>Tanggal Periksa</th>
                        <th>Catatan</th>
                        <th>Biaya Periksa</th>
                        <th>Diagnosa</th> <!-- Tambahkan kolom Diagnosa -->
                        <th>Obat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periksas as $index => $periksa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $periksa->id }}</td>
                        <td>{{ $periksa->pasien->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                        <td>{{ $periksa->catatan }}</td>
                        <td>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                        <td>{{ $periksa->diagnosa ?? 'Belum ada diagnosa' }}</td> <!-- Menampilkan Diagnosa -->
                        <td>
                            @if($periksa->detailPeriksa->count() > 0)
                                <ul class="mb-0 pl-3">
                                    @foreach($periksa->detailPeriksa as $detail)
                                        <li>{{ $detail->obat->nama_obat ?? '-' }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <em>Tidak ada obat</em>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dokter.periksa.show', $periksa->id) }}" class="btn btn-primary btn-sm">Periksa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection