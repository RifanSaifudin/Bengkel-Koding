<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class JadwalDokterController extends Controller
{
    /**
     * Tampilkan daftar jadwal periksa untuk dokter yang sedang login.
     */
    public function index()
    {
        // Pastikan hanya menampilkan jadwal milik dokter yang sedang login
        $jadwals = JadwalPeriksa::with('dokter') // eager load relasi agar efisien
                    ->where('dokter_id', Auth::id())
                    ->orderBy('hari') // opsional: bisa tambah urutan
                    ->get();

        return view('dokter.jadwal.index', compact('jadwals'));
    }
}
