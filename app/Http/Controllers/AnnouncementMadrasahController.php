<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementMadrasah;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementMadrasahController extends Controller
{
    public function index()
    {
        $data = AnnouncementMadrasah::paginate(5);
        return view('manage3landing.madrasah.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanmadrasah', 'public');
        }

        AnnouncementMadrasah::create($data);

        return redirect()->route('pengumumanmadrasah.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(AnnouncementMadrasah $pengumumanmadrasah)
    {
        return view('manage3landing.madrasah.pengumuman.edit', compact('pengumumanmadrasah'));
    }

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

    public function destroy(AnnouncementMadrasah $pengumumanmadrasah)
    {
        if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
            Storage::disk('public')->delete($pengumumanmadrasah->gambar);
        }

        $pengumumanmadrasah->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
