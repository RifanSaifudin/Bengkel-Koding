@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Detail Riwayat Pemeriksaan Pasien</h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Periksa</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Keluhan</th>
                        <th>Catatan</th>
                        <th>Obat</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d-m-Y H:i') }}</td>
                            <td>{{ $item->pasien->name ?? '-' }}</td>
                            <td>{{ $item->dokter->name ?? '-' }}</td>
                            <td>{{ $item->catatan ?? '-' }}</td>
                            <td>{{ $item->diagnosa ?? '-' }}</td>
                            <td>
                                @foreach($item->detailPeriksa as $detail)
                                    {{ $detail->obat->nama_obat ?? '-' }}<br>
                                @endforeach
                            </td>
                            <td>Rp{{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data riwayat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                <a href="{{ route('dokter.riwayat.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection