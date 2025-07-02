<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'poli'])
                ->where('id_dokter', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

        return view('dokter.periksa.index', compact('periksas'));
    }

    public function show($id)
    {
        $periksa = Periksa::with(['pasien'])->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.form', compact('periksa', 'obats'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'obat_id' => 'nullable|array',
            'diagnosa' => 'nullable|string',
        ]);

        $periksa = Periksa::findOrFail($id);

        $biayaTetap = 75000;
        $totalObat = 0;

        // Simpan obat ke detail_periksa
        if ($request->has('obat_id')) {
            foreach ($request->obat_id as $obatId) {
                $obat = Obat::findOrFail($obatId);
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat->id,
                    'biaya_periksa' => $obat->harga,
                ]);
                $totalObat += $obat->harga;
            }
        }

        $totalBiaya = $biayaTetap + $totalObat;

        $periksa->update([
            'diagnosa' => $request->diagnosa,
            'biaya_periksa' => $totalBiaya,
            'status' => 'Sudah diperiksa',
            'tgl_periksa' => now(),
        ]);

        return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'obat_id' => 'nullable|array',
        ]);

        $periksa = Periksa::findOrFail($id);

        // Hapus obat lama
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        $biayaTetap = 75000;
        $totalObat = 0;

        if ($request->has('obat_id')) {
            foreach ($request->obat_id as $obatId) {
                $obat = Obat::findOrFail($obatId);
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat->id,
                    'biaya_periksa' => $obat->harga,
                ]);
                $totalObat += $obat->harga;
            }
        }

        $totalBiaya = $biayaTetap + $totalObat;

        $periksa->update([
            'catatan' => $request->catatan,
            'biaya_periksa' => $totalBiaya,
        ]);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function jadwal()
    {
        $jadwals = JadwalPeriksa::with('dokter')
            ->where('dokter_id', auth()->id())
            ->get();

        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function simpanJadwal(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPeriksa::create([
            'dokter_id' => auth()->id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 1, // default aktif
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function ubahStatusJadwal($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->status = !$jadwal->status;
        $jadwal->save();

        return redirect()->back()->with('success', 'Status jadwal diperbarui');
    }

    public function edit($id)
    {
        $periksa = Periksa::with(['pasien', 'detailPeriksa'])->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.edit', compact('periksa', 'obats'));
    }

    public function profil()
    {
        $dokter = auth()->user()->load('poli');
        return view('dokter.profil', compact('dokter'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('dokter.profil')->with('success', 'Profil berhasil diperbarui.');
    }

}