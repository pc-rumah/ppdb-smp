<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\AnnouncementPondok;
use Illuminate\Support\Facades\Storage;

class AnnouncementPondokController extends Controller
{
    public function index()
    {
        $data = AnnouncementPondok::paginate(5);
        return view('manage3landing.pondok.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanpondok', 'public');
        }

        AnnouncementPondok::create($data);

        return redirect()->route('pengumumanpondok.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(AnnouncementPondok $pengumumanpondok)
    {
        return view('manage3landing.pondok.pengumuman.edit', compact('pengumumanpondok'));
    }

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

    public function destroy(AnnouncementPondok $pengumumanpondok)
    {
        if ($pengumumanpondok->gambar && Storage::disk('public')->exists($pengumumanpondok->gambar)) {
            Storage::disk('public')->delete($pengumumanpondok->gambar);
        }

        $pengumumanpondok->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
