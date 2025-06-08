<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Pest\Preset;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'juara' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subjudul' => 'required|string|max:255',
            'background_color' => 'required|string|max:7',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ]);

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

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'juara' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subjudul' => 'required|string|max:255',
            'background_color' => 'required|string|max:7',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

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
