@extends('adminlte::page')

@section('content')
<div class="content-header">
    <h4>Edit Dokter</h4>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-primary">
    <div class="card-header">Edit Data Dokter</div>
    <form method="POST" action="{{ route('admin.dokter.update', $dokter->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Nama</label>
                <input name="name" class="form-control" value="{{ $dokter->name }}" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input name="no_hp" class="form-control" value="{{ $dokter->no_hp }}" required inputmode="numeric" pattern="[0-9]*" maxlength="15">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="{{ $dokter->email }}" required>
            </div>
            <div class="form-group">
                <label>Poli</label>
                <select name="id_poli" class="form-control" required>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                            {{ $poli->nama_poli }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection