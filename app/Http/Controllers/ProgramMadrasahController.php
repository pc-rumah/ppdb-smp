<?php

namespace App\Http\Controllers;

use App\Models\ProgramMadrasah;
use Illuminate\Http\Request;

class ProgramMadrasahController extends Controller
{
    public function index()
    {
        $data = ProgramMadrasah::paginate(5);
        return view('manage3landing.madrasah.program.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        ProgramMadrasah::create([
            'title' => $request->nama,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->route('programmadrasah.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = ProgramMadrasah::find($id);
        return view('manage3landing.madrasah.program.edit', compact('data'));
    }

    public function update(Request $request, ProgramMadrasah $programmadrasah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $programmadrasah->update([
            'title' => $request->nama,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->route('programmadrasah.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(ProgramMadrasah $programmadrasah)
    {
        $programmadrasah->delete();

        return redirect()->route('programmadrasah.index')->with('success', 'Program berhasil dihapus.');
    }
}
