<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Cek role user yang login
        if (auth()->user()->role == 'dokter') {
            return redirect()->route('dokter.periksa.index'); // Route dokter
        } elseif (auth()->user()->role == 'pasien') {
            return redirect()->route('pasien.dashboard'); // Route pasien
        } else {
            return view('home'); // Kalau role tidak ada (misal admin) tetap tampilkan home biasa
        }
    }

    public function dokter()
    {
        return view('dokter.index');
    }
}
