<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periksa;

class RiwayatController extends Controller
{
    public function index()
    {
        $periksas = Periksa::where('id_pasien', auth()->user()->id)->get(); // Pastikan `auth()->user()->id` adalah ID pasien yang login
        return view('pasien.riwayat.index', compact('periksas'));
    }
}