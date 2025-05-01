<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Announcement::paginate(5);
        return view('announcement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        Announcement::create($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Announcement $pengumuman)
    {
        return view('announcement.edit', compact('pengumuman'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        $pengumuman = Announcement::findOrFail($id);
        $pengumuman->update($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(string $id)
    {
        $data = Announcement::findOrFail($id);
        $data->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Announcement deleted successfully.');
    }
}
