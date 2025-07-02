<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;
use App\Models\Obat;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jumlahDokter = User::where('role', 'dokter')->count();
        $jumlahPasien = User::where('role', 'pasien')->count();
        $jumlahPoli = Poli::count();
        $jumlahObat = Obat::count();

        return view('admin.dashboard', compact('jumlahDokter', 'jumlahPasien', 'jumlahPoli', 'jumlahObat'));
    }
}