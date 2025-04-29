<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periksa;

class DashboardController extends Controller
{
    public function index()
    {
        $periksas = Periksa::where('id_pasien', auth()->user()->id)->get();
        $latestPeriksa = $periksas->sortByDesc('tgl_periksa')->first(); 
        return view('pasien.index', compact('periksas', 'latestPeriksa'));
    }
}