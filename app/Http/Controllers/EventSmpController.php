<?php

namespace App\Http\Controllers;

use App\Models\EventSmp;
use Illuminate\Http\Request;

class EventSmpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventsmp = EventSmp::paginate(5);
        return view('sekolah.event.index', compact('eventsmp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekolah.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_type' => 'required|in:waktu,selesai',
            'waktu_selesai_time' => 'required_if:waktu_type,waktu|nullable|date_format:H:i',
            'waktu_selesai_text' => 'required_if:waktu_type,selesai|nullable|in:selesai',
            'deskripsi' => 'nullable|string',
        ]);

        $waktu_selesai = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        EventSmp::create([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil disimpan');
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
    public function edit(EventSmp $eventsmp)
    {
        return view('sekolah.event.edit', compact('eventsmp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSmp $eventsmp)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_type' => 'required|in:waktu,selesai',
            'waktu_selesai_time' => 'required_if:waktu_type,waktu|nullable|date_format:H:i',
            'waktu_selesai_text' => 'required_if:waktu_type,selesai|nullable|in:selesai',
            'deskripsi' => 'nullable|string',
        ]);

        $waktu_selesai = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        $eventsmp->update([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('eventsmp.index')->with('success', 'Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSmp $eventsmp)
    {
        $eventsmp->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
