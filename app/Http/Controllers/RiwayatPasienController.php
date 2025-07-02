<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        // Ambil pasien unik yang pernah diperiksa oleh dokter ini
        $pasienList = Periksa::with('pasien')
            ->where('id_dokter', auth()->id())
            ->get()
            ->groupBy('id_pasien');

        return view('dokter.riwayat.index', compact('pasienList'));
    }

    public function detail($id)
    {
        $riwayat = Periksa::with(['dokter', 'poli', 'detailPeriksa.obat', 'pasien'])
            ->where('id_pasien', $id)
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        $pasien = $riwayat->first()?->pasien;

        return view('dokter.riwayat.detail', compact('riwayat', 'pasien'));
    }
}