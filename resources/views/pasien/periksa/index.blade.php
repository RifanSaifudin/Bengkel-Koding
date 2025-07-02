@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Periksa</h1>
</section>

<section class="content">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">
        {{-- Form Daftar Poli --}}
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Pendaftaran</h3>
                </div>
                <form method="POST" action="{{ route('pasien.periksa.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->no_rm ?? '202506-' . auth()->id() }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="poli_id">Pilih Poli</label>
                            <select class="form-control" id="poli_id" name="poli_id" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jadwal_id">Pilih Jadwal</label>
                            <select class="form-control" id="jadwal_id" name="jadwal_id" required>
                                <option value="">-- Pilih Jadwal --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea name="keluhan" class="form-control" rows="2" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Riwayat Pendaftaran --}}
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pendaftaran</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Antrian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayats as $riwayat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $riwayat->poli->nama_poli ?? '-' }}</td>
                                    <td>{{ $riwayat->dokter->name ?? '-' }}</td>
                                    <td>{{ $riwayat->jadwal->hari ?? '-' }}</td>
                                    <td>{{ $riwayat->jadwal->jam_mulai ?? '-' }}</td>
                                    <td>{{ $riwayat->jadwal->jam_selesai ?? '-' }}</td>
                                    <td>{{ $riwayat->no_antrian ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $riwayat->status == 'Belum diperiksa' ? 'badge-danger' : 'badge-success' }}">
                                            {{ $riwayat->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('pasien.periksa.show', $riwayat->id) }}" class="btn btn-sm btn-info">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada riwayat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- kalo push tadi salah -->
@section('js')
<script>
    document.getElementById('poli_id').addEventListener('change', function () {
        const poliId = this.value;
        const jadwalSelect = document.getElementById('jadwal_id');
        jadwalSelect.innerHTML = '<option>Loading...</option>';

        fetch(`/get-jadwal-by-poli/${poliId}`)
            .then(response => response.json())
            .then(data => {
                jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                data.forEach(jadwal => {
                    const option = document.createElement('option');
                    option.value = jadwal.id;
                    option.textContent = `${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai} (${jadwal.dokter})`;
                    jadwalSelect.appendChild(option);
                });
            });
    });
</script>
@endsection