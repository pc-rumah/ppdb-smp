<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use Illuminate\Http\Request;
use App\Models\AnnouncementPondok;
use Illuminate\Support\Facades\Storage;

class AnnouncementPondokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AnnouncementPondok::paginate(5);
        return view('manage3landing.pondok.pengumuman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.pondok.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanpondok', 'public');
        }

        AnnouncementPondok::create($data);

        return redirect()->route('pengumumanpondok.index')->with('success', 'Pengumuman berhasil ditambahkan.');
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
    public function edit(AnnouncementPondok $pengumumanpondok)
    {
        return view('manage3landing.pondok.pengumuman.edit', compact('pengumumanpondok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnnouncementRequest $request, AnnouncementPondok $pengumumanpondok)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($pengumumanpondok->gambar && Storage::disk('public')->exists($pengumumanpondok->gambar)) {
                Storage::disk('public')->delete($pengumumanpondok->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('pengumumanpondok', 'public');
        }

        $pengumumanpondok->update($data);

        return redirect()->route('pengumumanpondok.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnouncementPondok $pengumumanpondok)
    {
        if ($pengumumanpondok->gambar && Storage::disk('public')->exists($pengumumanpondok->gambar)) {
            Storage::disk('public')->delete($pengumumanpondok->gambar);
        }

        $pengumumanpondok->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
