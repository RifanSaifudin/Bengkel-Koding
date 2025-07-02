@extends('layouts.app')

@section('content')
<div class="content-header"><h4>Tambah Obat</h4></div>

<form action="{{ route('admin.obat.store') }}" method="POST">
    @csrf
    <div class="card card-primary">
        <div class="card-body">
            <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Kemasan</label>
                <select name="kemasan" class="form-control" required>
                    <option value="">Pilih Kemasan</option>
                    <option value="Botol">Botol</option>
                    <option value="Pill">Pill</option>
                    <option value="Sachet">Sachet</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection