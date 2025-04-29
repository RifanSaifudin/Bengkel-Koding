<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\User;

class PeriksaController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa.index', compact('dokters'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'keluhan' => 'required|string',
            'dokter_id' => 'required|exists:users,id', // Pastikan dokter dipilih
        ]);

        // Masukkan keluhan pasien dan informasi lain
        $periksa = Periksa::create([
            'id_pasien' => auth()->user()->id,  // menggunakan ID pasien yang sedang login
            'id_dokter' => $validatedData['dokter_id'], // dokter yang dipilih oleh pasien
            'tgl_periksa' => now(),
            'catatan' => $validatedData['keluhan'],
            'biaya_periksa' => null // biaya periksa ditangani dokter
        ]);

        // Redirect atau beri feedback setelah berhasil
        return redirect()->route('pasien.dashboard')->with('success', 'Pendaftaran pemeriksaan berhasil');
    }
}