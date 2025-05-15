<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::all();
        return view('unit.index', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $originalName = $file->getClientOriginalName();
            $timestamp = Carbon::now()->format('Ymd_His');
            $filename = $timestamp . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $validated['gambar'] = $file->storeAs('unit', $filename, 'public');
        }

        // Simpan data ke database
        Unit::create($validated);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil ditambahkan.');
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
        $unit = Unit::find($id);
        return view('unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Jika ada file baru, hapus gambar lama dan upload yang baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($unit->gambar && Storage::disk('public')->exists($unit->gambar)) {
                Storage::disk('public')->delete($unit->gambar);
            }

            $file = $request->file('gambar');
            $originalName = $file->getClientOriginalName();
            $timestamp = Carbon::now()->format('Ymd_His');
            $filename = $timestamp . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $validated['gambar'] = $file->storeAs('unit', $filename, 'public');
        }

        // Update data unit
        $unit->update($validated);

        return redirect()->route('unit.index')->with('success', 'Unit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::find($id);

        // Hapus gambar jika ada
        if ($unit->gambar && Storage::disk('public')->exists($unit->gambar)) {
            Storage::disk('public')->delete($unit->gambar);
        }

        // Hapus data unit
        $unit->delete();

        return redirect()->route('unit.index')->with('success', 'Unit berhasil dihapus.');
    }
}
