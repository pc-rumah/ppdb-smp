<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EkstraController extends Controller
{
    public function index()
    {
        $data = Ekstra::paginate(5);
        return view('sekolah.ekstra.index', compact('data'));
    }

    public function create()
    {
        return view('sekolah.ekstra.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ekstra::create($validated);

        return redirect()->route('ekstra.index')->with('success', 'Data ekstrakurikuler berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Ekstra::find($id);
        return view('sekolah.ekstra.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string',
        ]);

        $ekstra = Ekstra::findOrFail($id);
        $ekstra->update($validated);

        return redirect()->route('ekstra.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $data = Ekstra::findOrFail($id);

        $data->delete();
        return redirect()->route('ekstra.index')->with('success', 'Data Berhasil di Hapus');
    }
}
