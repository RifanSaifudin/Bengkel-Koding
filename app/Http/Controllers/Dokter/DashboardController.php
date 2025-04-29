<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periksa;

class DashboardController extends Controller
{
    public function index()
    {
        $latestPeriksa = Periksa::orderBy('tgl_periksa', 'desc')->with('pasien')->first();
        $periksas = Periksa::with('pasien')->orderBy('tgl_periksa', 'desc')->get();

        return view('dokter.index', compact('latestPeriksa', 'periksas'));
    }
}
