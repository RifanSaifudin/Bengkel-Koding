<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Semua method wajib user login
    }

    /**
     * Show the application dashboard based on user role.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'dokter') {
            return redirect()->route('dokter.periksa.index');
        } elseif ($user->role == 'pasien') {
            return redirect()->route('pasien.dashboard');
        } else {
            return view('home'); // Default jika role tidak terdaftar
        }
    }

    /**
     * Dokter dashboard view.
     */
    public function dokter()
    {
        return view('dokter.index');
    }
}
