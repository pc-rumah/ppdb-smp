<?php

namespace App\Http\Controllers;

use App\Models\EventPondok;
use Illuminate\Http\Request;

class EventPondokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EventPondok::paginate(5);
        return view('manage3landing.pondok.event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage3landing.pondok.event.create');
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

        EventPondok::create([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil disimpan');
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
    public function edit(EventPondok $eventpondok)
    {
        return view('manage3landing.pondok.event.edit', compact('eventpondok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventPondok $eventpondok)
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

        $eventpondok->update([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('eventpondok.index')->with('success', 'Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventPondok $eventpondok)
    {
        $eventpondok->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
