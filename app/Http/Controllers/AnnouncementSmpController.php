<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\AnnouncementSmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementSmpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumansmp = AnnouncementSmp::paginate(5);
        return view('sekolah.pengumuman.index', compact('pengumumansmp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekolah.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumansmp', 'public');
        }

        AnnouncementSmp::create($data);

        return redirect()->route('pengumumansmp.index')->with('success', 'Data Berhasil ditambah');
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
    public function edit(AnnouncementSmp $pengumumansmp)
    {
        return view('sekolah.pengumuman.edit', compact('pengumumansmp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnnouncementRequest $request, AnnouncementSmp $pengumumansmp)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($pengumumansmp->gambar && Storage::disk('public')->exists($pengumumansmp->gambar)) {
                Storage::disk('public')->delete($pengumumansmp->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('pengumumansmp', 'public');
        }

        $pengumumansmp->update($data);

        return redirect()->route('pengumumansmp.index')->with('success', 'Data Berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnnouncementSmp $pengumumansmp)
    {
        if ($pengumumansmp->gambar && Storage::disk('public')->exists($pengumumansmp->gambar)) {
            Storage::disk('public')->delete($pengumumansmp->gambar);
        }

        $pengumumansmp->delete();

        return redirect()->back()->with('success', 'Data Berhasil di hapus');
    }
}
