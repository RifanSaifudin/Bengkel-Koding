<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::where('id_dokter', auth()->user()->id)
            ->with('pasien', 'detailPeriksa.obat')
            ->get();

        return view('dokter.periksa.index', compact('periksas'));
    }

    public function show($id)
    {
        $periksa = Periksa::with(['pasien', 'dokter', 'detailPeriksa.obat'])->findOrFail($id);
        $obats = Obat::all();

        return view('dokter.periksa.show', compact('periksa', 'obats'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'obat_id' => 'nullable|array',
            'biaya_periksa' => 'nullable|numeric',
            'diagnosa' => 'nullable|string',
            'id_periksa' => 'required|exists:periksas,id',
        ]);

        // Ambil data periksa berdasarkan ID dari form
        $periksaModel = Periksa::findOrFail($request->id_periksa);

        // Update data periksa
        $periksaModel->update([
            'biaya_periksa' => $request->biaya_periksa,
            'diagnosa' => $request->diagnosa,
        ]);

        // Simpan detail periksa jika ada obat
        if ($request->has('obat_id') && !empty($request->obat_id)) {
            foreach ($request->obat_id as $obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksaModel->id,
                    'id_obat' => $obat,
                    'biaya_periksa' => $request->biaya_periksa,
                ]);
            }
        }

        return redirect()->route('dokter.periksa.index')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'biaya_periksa' => 'required|numeric|min:0',
        ]);

        $periksa = Periksa::findOrFail($id);
        $periksa->biaya_periksa = $request->input('biaya_periksa');
        $periksa->save();

        return redirect()->route('dokter.periksa.index')
                         ->with('success', 'Biaya periksa berhasil diperbarui');
    }
}
