@extends('adminlte::page')

@section('content')
<div class="content-header"><h4>Edit Obat</h4></div>

<form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="card card-primary">
        <div class="card-body">
            <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
            </div>

            <div class="form-group">
                <label>Kemasan</label>
                <select name="kemasan" class="form-control" required>
                    <option value="">Pilih Kemasan</option>
                    <option value="Botol" {{ $obat->kemasan == 'Botol' ? 'selected' : '' }}>Botol</option>
                    <option value="Pill" {{ $obat->kemasan == 'Pill' ? 'selected' : '' }}>Pill</option>
                    <option value="Sachet" {{ $obat->kemasan == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ $obat->harga }}" required>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection