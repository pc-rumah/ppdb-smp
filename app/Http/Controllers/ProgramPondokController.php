<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPondok;
use Illuminate\Support\Facades\Storage;

class ProgramPondokController extends Controller
{
    public function index()
    {
        $data = ProgramPondok::paginate(5);
        return view('manage3landing.pondok.program.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_program', 'public');
        }

        ProgramPondok::create($validated);

        return redirect()->route('programpondok.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $data = ProgramPondok::find($id);
        return view('manage3landing.pondok.program.edit', compact('data'));
    }

    public function update(Request $request, ProgramPondok $programpondok)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['nama']);
        if ($request->hasFile('foto')) {
            if ($programpondok->foto && Storage::disk('public')->exists($programpondok->foto)) {
                Storage::disk('public')->delete($programpondok->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('foto_program', $filename, 'public');

            $data['foto'] = $filePath;
        }
        $programpondok->update($data);

        return redirect()->route('programpondok.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(ProgramPondok $programpondok)
    {
        if ($programpondok->kategori()->exists()) {
            return redirect()->route('programpondok.index')
                ->with('error', 'Data tidak bisa dihapus karena masih digunakan oleh Item Program.');
        }

        if ($programpondok->foto && Storage::disk('public')->exists($programpondok->foto)) {
            Storage::disk('public')->delete($programpondok->foto);
        }

        $programpondok->delete();

        return redirect()->route('programpondok.index')->with('success', 'Data berhasil dihapus.');
    }
}
