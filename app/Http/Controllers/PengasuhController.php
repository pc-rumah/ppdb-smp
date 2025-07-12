<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengasuhRequest;
use App\Models\Pengasuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengasuhController extends Controller
{
    public function index()
    {
        $data = Pengasuh::paginate(5);
        return view('manage3landing.pondok.pengasuh.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.pengasuh.create');
    }

    public function store(PengasuhRequest $request)
    {
        $request->validated();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengasuh', 'public');
        } else {
            $fotoPath = null;
        }

        Pengasuh::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pengasuh.index')->with('success', 'Data pengasuh berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $data = Pengasuh::find($id);
        return view('manage3landing.pondok.pengasuh.edit', compact('data'));
    }

    public function update(PengasuhRequest $request, Pengasuh $pengasuh)
    {
        $request->validated();

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            if ($pengasuh->foto && Storage::disk('public')->exists($pengasuh->foto)) {
                Storage::disk('public')->delete($pengasuh->foto);
            }

            $data['foto'] = $request->file('foto')->store('pengasuh', 'public');
        }

        $pengasuh->update($data);

        return redirect()->route('pengasuh.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = Pengasuh::findOrFail($id);

        $data->delete();
        return redirect()->route('pengasuh.index')->with('success', 'Data Berhasil di Hapus');
    }
}
