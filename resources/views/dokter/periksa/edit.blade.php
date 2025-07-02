@extends('layouts.app')

@section('content')
<div class="content-header">
    <h4>Edit Pemeriksaan Pasien</h4>
</div>

<form method="POST" action="{{ route('dokter.periksa.update', $periksa->id) }}">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Nama Pasien</label>
                <input type="text" class="form-control" value="{{ $periksa->pasien->name }}" readonly>
            </div>

            <div class="form-group">
                <label>Keluhan</label>
                <textarea class="form-control" readonly>{{ $periksa->catatan }}</textarea>
            </div>

            <div class="form-group">
                <label>Catatan (Diagnosa)</label>
                <textarea name="catatan" class="form-control" required>{{ old('catatan', $periksa->catatan) }}</textarea>
            </div>

            <div class="form-group">
                <label>Obat</label>
                @foreach($obats as $obat)
                    <div class="form-check">
                        <input class="form-check-input obat-checkbox" type="checkbox" name="obat_id[]" value="{{ $obat->id }}"
                            id="obat{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                            {{ $periksa->detailPeriksa->where('id_obat', $obat->id)->count() ? 'checked' : '' }}>
                        <label class="form-check-label" for="obat{{ $obat->id }}">
                            {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label>Total Biaya Pemeriksaan</label>
                <input type="text" id="total_harga" class="form-control" readonly>
                <input type="hidden" name="biaya_periksa" id="hidden_biaya">
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Perbarui</button>
            <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</form>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hargaTetap = 75000;
        const checkboxes = document.querySelectorAll('.obat-checkbox');
        const tampil = document.getElementById('total_harga');
        const hidden = document.getElementById('hidden_biaya');

        function updateHarga() {
            let totalObat = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    totalObat += parseInt(cb.dataset.harga);
                }
            });

            const total = hargaTetap + totalObat;
            tampil.value = 'Rp' + total.toLocaleString('id-ID');
            hidden.value = total;
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateHarga);
        });

        updateHarga(); // run on load
    });
</script>
@endsection