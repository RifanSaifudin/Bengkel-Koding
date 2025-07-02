<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;

class RiwayatController extends Controller
{
    public function index()
    {
        $pasienId = Auth::id();

        $riwayat = Periksa::with(['dokter', 'poli', 'detailPeriksa.obat'])
                    ->where('id_pasien', $pasienId)
                    ->latest()
                    ->get();

        return view('pasien.riwayat.index', compact('riwayat'));

        // $periksas = Periksa::where('id_pasien', auth()->user()->id)->get(); // Pastikan `auth()->user()->id` adalah ID pasien yang login
        // return view('pasien.riwayat.index', compact('periksas'));
    }
}