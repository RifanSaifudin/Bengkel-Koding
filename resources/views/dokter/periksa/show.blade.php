@extends('layouts.app')

@section('content')
<div class="content-header">
    <h4>Form Pemeriksaan Pasien</h4>
</div>

<form method="POST" action="{{ route('dokter.periksa.store', $periksa->id) }}">
    @csrf
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $periksa->pasien->name }}</p>
            <p><strong>Keluhan:</strong> {{ $periksa->catatan }}</p>

            <div class="form-group">
                <label>Diagnosa</label>
                <textarea name="diagnosa" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>Obat</label>
                @foreach($obats as $obat)
                    <div class="form-check">
                        <input class="form-check-input obat-checkbox" type="checkbox" name="obat_id[]" value="{{ $obat->id }}" id="obat{{ $obat->id }}" data-harga="{{ $obat->harga }}">
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
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</form>
@endsection

@push('js')
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

        updateHarga(); // Jalankan saat halaman pertama kali terbuka
    });
</script>
@endpush