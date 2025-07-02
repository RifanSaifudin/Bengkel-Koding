@extends('adminlte::page')

@section('title', 'Manajemen Dokter')

@section('content_header')
    <h1>Manajemen Dokter</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-primary">
        <div class="card-header">Tambah Dokter</div>
        <form method="POST" action="{{ route('admin.dokter.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>No HP</label>
                    <input name="no_hp" class="form-control" required inputmode="numeric" pattern="[0-9]*" maxlength="15">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Poli</label>
                    <select name="id_poli" class="form-control" required>
                        <option value="">Pilih Poli</option>
                        @foreach($polis as $poli)
                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </form>
    </div>

    <div class="card mt-4">
        <div class="card-header">Data Dokter</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Poli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokters as $dokter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dokter->name }}</td>
                            <td>{{ $dokter->alamat }}</td>
                            <td>{{ $dokter->no_hp }}</td>
                            <td>{{ $dokter->poli->nama_poli ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection