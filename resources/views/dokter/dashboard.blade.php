@extends('layouts.app')

@section('content')
<div class="content-header">
    <h4>Dashboard Dokter</h4>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jumlahDokter }}</h3>
                <p>Jumlah Dokter</p>
            </div>
            <div class="icon"><i class="fas fa-user-md"></i></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $jumlahPasien }}</h3>
                <p>Jumlah Pasien</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jumlahPoli }}</h3>
                <p>Jumlah Poli</p>
            </div>
            <div class="icon"><i class="fas fa-hospital-alt"></i></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $jumlahObat }}</h3>
                <p>Jumlah Obat</p>
            </div>
            <div class="icon"><i class="fas fa-pills"></i></div>
        </div>
    </div>
</div>
@endsection