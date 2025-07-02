@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Jadwal Periksa</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                        <td>{{ $jadwal->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
