@extends('layouts.app')

@section('content')
<div class="content-header">
    <h1>Profil Dokter</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <form action="{{ route('dokter.profil.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $dokter->name) }}" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $dokter->alamat) }}">
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $dokter->no_hp) }}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection