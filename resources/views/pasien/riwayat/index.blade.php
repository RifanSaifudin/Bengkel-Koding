@extends('layouts.app')

@section('title', 'Riwayat Periksa')
@section('content_header_title', 'Riwayat Periksa')
@section('content_body')
    <section class="content">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">Data Riwayat Pemeriksaan</h3>
            </div>
            <div class="card-body">
                @if($riwayat->isEmpty())
                    <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Dokter</th>
                                <th>Poli</th>
                                <th>Catatan</th>
                                <th>Keluhan</th>
                                <th>Obat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat as $index => $periksa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</td>
                                    <td>{{ $periksa->dokter->name ?? '-' }}</td>
                                    <td>{{ $periksa->poli->nama_poli ?? '-' }}</td>
                                    <td>{{ $periksa->diagnosa ?? '-' }}</td>
                                    <td>{{ $periksa->catatan ?? '-' }}</td>
                                    <td>
                                        @if($periksa->detailPeriksa->count() > 0)
                                            <ul>
                                                @foreach($periksa->detailPeriksa as $detail)
                                                    <li>{{ $detail->obat->nama_obat ?? '-' }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <em>Tidak ada obat</em>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>
@endsection