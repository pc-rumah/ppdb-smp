<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $data = Announcement::paginate(5);
        return view('announcement.index', compact('data'));
    }

    public function create()
    {
        return view('announcement.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        Announcement::create($validatedData);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Announcement $pengumuman)
    {
        return view('announcement.edit', compact('pengumuman'));
    }

    public function update(Request $request, Announcement $pengumuman)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        $pengumuman->update($validatedData);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
