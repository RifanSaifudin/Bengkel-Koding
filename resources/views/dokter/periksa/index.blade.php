@extends('layouts.app')

@section('content')
<div class="content-header">
    <h4>Daftar Pasien untuk Diperiksa</h4>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($periksas as $periksa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $periksa->pasien->name ?? '-' }}</td>
                        <td>{{ $periksa->catatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}</td>
                        <td>
                            <span class="badge {{ $periksa->diagnosa ? 'badge-success' : 'badge-warning' }}">
                                {{ $periksa->diagnosa ? 'Sudah Diperiksa' : 'Belum' }}
                            </span>
                        </td>
                        <td>
                            @if($periksa->diagnosa)
                                <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            @else
                                <a href="{{ route('dokter.periksa.show', $periksa->id) }}" class="btn btn-sm btn-primary">Periksa</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection