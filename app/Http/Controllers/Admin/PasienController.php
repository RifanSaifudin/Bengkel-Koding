<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_hp' => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'no_ktp' => 'required|digits:16|unique:users,no_ktp',
        ]);

        // Generate no_rm otomatis, misal: RM00123
        // $lastId = \App\Models\User::where('role', 'pasien')->max('id') ?? 0;
        // $no_rm = 'RM' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
        
        $count = \App\Models\User::where('role', 'pasien')->count();
        $no_rm = 'RM' . str_pad($count + 1, 5, '0', STR_PAD_LEFT);

        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'alamat' => $validated['alamat'],
            'no_hp' => $validated['no_hp'],
            'no_ktp' => $validated['no_ktp'],
            'no_rm' => $no_rm,
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil disimpan.');
    }

    public function edit($id)
    {
        $pasien = User::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string',
            'alamat'  => 'required|string',
            'no_hp'   => 'required|digits_between:10,15|regex:/^[0-9]+$/',
            'no_ktp'  => 'required|digits:16|regex:/^[0-9]+$/',
            'email'   => 'required|email|unique:users,email,' . $id,
        ]);

        $pasien = User::findOrFail($id);

        $pasien->update([
            'name'    => $request->name,
            'alamat'  => $request->alamat,
            'no_hp'   => $request->no_hp,
            'email'   => $request->email,
            'no_ktp'  => $request->no_ktp,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasien = User::findOrFail($id);

        if ($pasien->role !== 'pasien') {
            return back()->with('error', 'Hanya data pasien yang bisa dihapus.');
        }

        $pasien->delete();

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}