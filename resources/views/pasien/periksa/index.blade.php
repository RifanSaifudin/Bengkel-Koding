@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <section class="content-header">
        <h1>Pasien <small>Periksa</small></h1>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Periksa</h3></div>
            <form method="POST" action="{{ route('pasien.periksa.store') }}">
                @csrf
                <div class="card-body">
                    <!-- Tampilkan nama pasien yang sedang login -->
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama_pasien" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <!-- Keluhan pasien -->
                    <div class="form-group">
                        <label for="keluhan">Keluhan Anda</label>
                        <textarea class="form-control" id="keluhan" name="keluhan" placeholder="Masukkan keluhan Anda" required></textarea>
                    </div>

                    <!-- Pilih Dokter -->
                    <div class="form-group">
                        <label for="dokter_id">Pilih Dokter</label>
                        <select class="form-control" id="dokter_id" name="dokter_id" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection