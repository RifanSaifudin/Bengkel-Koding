@extends('layouts.app')

@section('content')
<div class="content-header"><h4>Manajemen Poli</h4></div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-primary">
    <div class="card-header">{{ isset($poli) ? 'Edit Poli' : 'Tambah Poli' }}</div>
    <form method="POST" action="{{ isset($poli) ? route('admin.poli.update', $poli->id) : route('admin.poli.store') }}">
        @csrf
        @if(isset($poli)) @method('PUT') @endif
        <div class="card-body">
            <div class="form-group">
                <label>Nama Poli</label>
                <input name="nama_poli" class="form-control" value="{{ old('nama_poli', $poli->nama_poli ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $poli->deskripsi ?? '') }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">{{ isset($poli) ? 'Update' : 'Simpan' }}</button>
            @if(isset($poli))
                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary">Batal</a>
            @else
                <button class="btn btn-secondary" type="reset">Reset</button>
            @endif
        </div>
    </form>
</div>

<div class="card mt-4">
    <div class="card-header">Daftar Poli</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr>
                <th>No</th><th>Nama Poli</th><th>Deskripsi</th><th>Aksi</th>
            </tr></thead>
            <tbody>
                @foreach($polis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_poli }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <a href="{{ route('admin.poli.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.poli.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
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