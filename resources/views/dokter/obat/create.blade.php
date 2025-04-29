@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('dokter.obat.store') }}" method="POST">
                @csrf {{-- harus ada di form untuk proteksi, biar gaada anomali--}}
                <div class="form-group">
                    <label for="nama">Nama obat</label>
                    <input type="text" name="nama_obat" id="nama" placeholder="Nama obat" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Kemasan</label>
                    {{-- ambil template option di bawah ini di adminLTE nya https://jeroennoten.github.io/Laravel-AdminLTE/ -> components -> basic form components --}}
                    <x-adminlte-select name="kemasan">
                        <x-adminlte-options :options="['Pill' => 'Pill', 'Sachet' => 'Sachet', 'Botol' => 'Botol']"
                            empty-option="Pilih kemasan"/>
                    </x-adminlte-select>
                </div>
                <div class="form-group">
                    <label for="nama">Harga</label>
                    <input type="number" name="harga" id="harga" placeholder="Harga obat" class="form-control" required>
                </div>
                <div class="wrappper d-flex justify-content-end" style="gap:10px;">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection