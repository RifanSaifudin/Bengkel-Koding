@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>Jadwal Periksa</h1>
</section>

<section class="content">
    <div class="row">
        {{-- Tabel Jadwal --}}
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal Saya</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jadwal->dokter->name ?? '-' }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        <span class="badge {{ $jadwal->status ? 'badge-success' : 'badge-danger' }}">
                                            {{ $jadwal->status ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('dokter.jadwal.status', $jadwal->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-warning" onclick="return confirm('Ubah status jadwal ini?')">Ubah Status</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada jadwal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Form Tambah Jadwal --}}
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Jadwal</h3>
                </div>
                <form method="POST" action="{{ route('dokter.jadwal.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <select name="hari" class="form-control" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection