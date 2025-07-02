@extends('adminlte::page')

@section('content')
<div class="content-header"><h4>Manajemen Obat</h4></div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-primary">
    <div class="card-header">{{ isset($obat) ? 'Edit Obat' : 'Tambah Obat' }}</div>
    <form method="POST" action="{{ isset($obat) ? route('admin.obat.update', $obat->id) : route('admin.obat.store') }}">
        @csrf
        @if(isset($obat))
            @method('PUT')
        @endif
        <div class="card-body">
            <div class="form-group">
                <label>Nama Obat</label>
                <input name="nama_obat" class="form-control" value="{{ old('nama_obat', $obat->nama_obat ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Kemasan</label>
                <select name="kemasan" class="form-control" required>
                    <option value="">Pilih Kemasan</option>
                    @foreach(['Botol', 'Pill', 'Sachet'] as $item)
                        <option value="{{ $item }}" {{ (old('kemasan', $obat->kemasan ?? '') == $item) ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input name="harga" type="number" class="form-control" value="{{ old('harga', $obat->harga ?? '') }}" required>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">{{ isset($obat) ? 'Update' : 'Simpan' }}</button>
            <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card mt-4">
    <div class="card-header">Data Obat</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead><tr>
                <th>No</th><th>Nama Obat</th><th>Kemasan</th><th>Harga</th><th>Aksi</th>
            </tr></thead>
            <tbody>
                @foreach($obats as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_obat }}</td>
                        <td>{{ $item->kemasan }}</td>
                        <td>Rp {{ number_format($item->harga) }}</td>
                        <td>
                            <a href="{{ route('admin.obat.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.obat.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection