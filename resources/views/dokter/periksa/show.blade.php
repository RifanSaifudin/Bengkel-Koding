@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<section class="content-header">
    <h1>Dokter <small>Periksa Pasien</small></h1>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Detail Periksa</h3>
        </div>
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $periksa->pasien->name }}</p>
            <p><strong>Dokter:</strong> {{ $periksa->dokter->name }}</p>
            <p><strong>Tanggal Periksa:</strong> {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d-m-Y') }}</p>
            <p><strong>Catatan:</strong> {{ $periksa->catatan }}</p>
            <p><strong>Biaya Periksa:</strong> Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</p>
            <p><strong>Diagnosa:</strong> {{ $periksa->diagnosa }}</p>

            <!-- Menampilkan pesan error jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokter.periksa.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_periksa" value="{{ $periksa->id }}">

                <div class="form-group">
                    <label for="diagnosa">Diagnosa:</label>
                    <textarea name="diagnosa" class="form-control" rows="4">{{ old('diagnosa', $periksa->diagnosa) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="obat">Pilih Obat:</label>
                    <select name="obat_id[]" class="form-control" multiple>
                        @foreach($obats as $obat)
                            <option value="{{ $obat->id }}">
                                {{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp {{ number_format($obat->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="biaya_periksa">Biaya Periksa:</label>
                    <input type="text" name="biaya_periksa" class="form-control" value="{{ old('biaya_periksa', $periksa->biaya_periksa) }}">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</section>
@endsection
