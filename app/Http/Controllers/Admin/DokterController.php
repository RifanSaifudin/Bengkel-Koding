<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        $polis = Poli::all();
        return view('admin.dokter.index', compact('dokters', 'polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'id_poli' => 'required|exists:polis,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'id_poli' => $validated['id_poli'],
            'role' => 'dokter', // pastikan set rolenya
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokter = User::findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokter = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'id_poli' => 'required|exists:polis,id',
        ]);

        $dokter->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'id_poli' => $request->id_poli,
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Dokter berhasil dihapus.');

        $dokter = User::findOrFail($id);

        if ($dokter->role !== 'dokter') {
            return back()->with('error', 'Hanya data dokter yang bisa dihapus.');
        }

        $pasien->delete();

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}