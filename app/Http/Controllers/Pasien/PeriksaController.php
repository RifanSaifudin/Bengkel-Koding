<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\Periksa;
use App\Models\JadwalPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $polis = \App\Models\Poli::all();

        $riwayats = \App\Models\Periksa::with(['poli', 'dokter', 'jadwal'])
                    ->where('id_pasien', $user->id)
                    ->latest()
                    ->get();

        return view('pasien.periksa.index', compact('polis', 'riwayats'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'jadwal_id' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
        ]);

        // Cek apakah pasien sudah mendaftar ke jadwal yang sama hari ini
        $exists = Periksa::where('id_pasien', auth()->id())
            ->where('jadwal_id', $request->jadwal_id)
            ->whereDate('tgl_periksa', now()->toDateString())
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar pada jadwal ini.');
        }

        // Ambil data jadwal
        $jadwal = \App\Models\JadwalPeriksa::findOrFail($request->jadwal_id);

        // Hitung nomor antrian
        $antrian = Periksa::where('jadwal_id', $jadwal->id)
                        ->whereDate('tgl_periksa', now()->toDateString())
                        ->count() + 1;

        // Simpan data pendaftaran
        Periksa::create([
            'id_pasien'     => auth()->id(),
            'id_dokter'     => $jadwal->dokter_id,
            'poli_id'       => $request->poli_id,
            'jadwal_id'     => $request->jadwal_id,
            'tgl_periksa'   => now(),
            'catatan'       => $request->keluhan,
            'no_antrian'    => $antrian,
            'status'        => 'Belum diperiksa',
        ]);

        return redirect()->route('pasien.periksa.index')->with('success', 'Pendaftaran berhasil.');
    }

    public function show($id)
    {
        $periksa = Periksa::with(['dokter', 'poli', 'detailPeriksa.obat', 'pasien', 'jadwal'])
                    ->where('id', $id)
                    ->where('id_pasien', auth()->id()) // agar hanya pasien yang sesuai bisa lihat
                    ->firstOrFail();

        return view('pasien.periksa.show', compact('periksa'));
    }

    private function getNextAntrian($jadwal_id)
    {
        return Periksa::where('jadwal_id', $jadwal_id)->count() + 1;
    }

}