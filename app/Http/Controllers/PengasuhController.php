<?php

namespace App\Http\Controllers;

use App\Models\Pengasuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengasuhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengasuh::paginate(5);
        return view('manage3landing.pondok.pengasuh.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.pondok.pengasuh.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file foto
        $fotoPath = $request->file('foto')->store('pengasuh', 'public');

        Pengasuh::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pengasuh.index')->with('success', 'Data pengasuh berhasil disimpan.');
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
        $data = Pengasuh::find($id);
        return view('manage3landing.pondok.pengasuh.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengasuh $pengasuh)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
                Storage::disk('public')->delete($pengasuh->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')->store('pengasuh', 'public');
        }

        $pengasuh->update($data);

        return redirect()->route('pengasuh.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pengasuh::findOrFail($id);

        $data->delete();
        return redirect()->route('pengasuh.index')->with('success', 'Data Berhasil di Hapus');
    }
}
