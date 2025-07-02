@extends('adminlte::page')

@section('title', 'Edit Pasien')

@section('content_header')
    <h1>Edit Pasien</h1>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-primary">
    <div class="card-header">Edit Data Pasien</div>
    <form method="POST" action="{{ route('admin.pasien.update', $pasien->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>No. Rekam Medis (No. RM)</label>
                <input type="text" class="form-control" value="{{ $pasien->no_rm }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input name="name" class="form-control" value="{{ old('name', $pasien->name) }}" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" class="form-control" value="{{ old('alamat', $pasien->alamat) }}" required>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input name="no_hp" class="form-control" value="{{ old('no_hp', $pasien->no_hp) }}" required>
            </div>
            <div class="form-group">
                <label>No KTP</label>
                <input name="no_ktp" class="form-control" value="{{ old('no_ktp', $pasien->no_ktp) }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{ old('email', $pasien->email) }}" required>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection