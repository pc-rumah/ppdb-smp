<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementMadrasah;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementMadrasahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AnnouncementMadrasah::paginate(5);
        return view('manage3landing.madrasah.pengumuman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.madrasah.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanmadrasah', 'public');
        }

        AnnouncementMadrasah::create($data);

        return redirect()->route('pengumumanmadrasah.index')->with('success', 'Pengumuman berhasil ditambahkan.');
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
    public function edit(AnnouncementMadrasah $pengumumanmadrasah)
    {
        return view('manage3landing.madrasah.pengumuman.edit', compact('pengumumanmadrasah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnnouncementRequest $request, AnnouncementMadrasah $pengumumanmadrasah)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
                Storage::disk('public')->delete($pengumumanmadrasah->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('pengumumanmadrasah', 'public');
        }

        $pengumumanmadrasah->update($data);

        return redirect()->route('pengumumanmadrasah.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnouncementMadrasah $pengumumanmadrasah)
    {
        if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
            Storage::disk('public')->delete($pengumumanmadrasah->gambar);
        }

        $pengumumanmadrasah->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
