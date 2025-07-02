@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Detail Pemeriksaan</h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <tr>
                    <th>No. RM</th>
                    <td>{{ $periksa->pasien->no_rm ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Pasien</th>
                    <td>{{ $periksa->pasien->name }}</td>
                </tr>
                <tr>
                    <th>Nama Dokter</th>
                    <td>{{ $periksa->dokter->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal Periksa</th>
                    <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $periksa->catatan }}</td>
                </tr>
                <tr>
                    <th>Obat</th>
                    <td>
                        @forelse($periksa->detailPeriksa as $detail)
                            {{ $detail->obat->nama_obat }}<br>
                        @empty
                            -
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <th>Total Biaya</th>
                    <td>Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                </tr>
            </table>
            <a href="{{ route('pasien.periksa.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</section>
@endsection