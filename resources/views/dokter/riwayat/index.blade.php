@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Riwayat Pasien</h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>No RM</th>
                        <th>Alamat</th>
                        <th>No KTP</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasienList as $index => $group)
                        @php $pasien = $group->first()->pasien; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pasien->name }}</td>
                            <td>{{ $pasien->no_rm ?? '-' }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td>{{ $pasien->no_ktp }}</td>
                            <td>{{ $pasien->no_hp }}</td>
                            <td>
                                <a href="{{ route('dokter.riwayat.detail', $pasien->id) }}" class="btn btn-sm btn-info">
                                    Detail Riwayat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pasien.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection