<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrestasiRequest;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $data = Prestasi::paginate(5);
        return view('sekolah.prestasi.index', compact('data'));
    }

    public function create()
    {
        return view('sekolah.prestasi.create');
    }

    public function store(PrestasiRequest $request)
    {
        $validated = $request->validated();

        $path = $request->file('foto')->store('prestasi', 'public');

        Prestasi::create([
            'juara' => $validated['juara'],
            'title' => $validated['title'],
            'subjudul' => $validated['subjudul'],
            'background_color' => $validated['background_color'],
            'foto' => $path,
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil disimpan.');
    }

    public function edit(string $id)
    {
        $data = Prestasi::find($id);
        return view('sekolah.prestasi.edit', compact('data'));
    }

    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $validated = $request->validated();

        $data = [
            'juara' => $validated['juara'],
            'title' => $validated['title'],
            'subjudul' => $validated['subjudul'],
            'background_color' => $validated['background_color'],
        ];

        if ($request->hasFile('foto')) {
            if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $data = Prestasi::findOrFail($id);

        if ($data->foto && Storage::disk('public')->exists($data->foto)) {
            Storage::disk('public')->delete($data->foto);
        }

        $data->delete();

        return redirect()->route('prestasi.index')->with('success', 'Data Prestasi berhasil dihapus.');
    }
}
