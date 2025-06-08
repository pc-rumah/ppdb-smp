<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $data = Event::paginate(5);
        return view('event.index', compact('data'));
    }

    public function create()
    {
        return view('event.create');
    }

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

        Event::create([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i:s',
            'waktu_type' => 'required|in:waktu,selesai',
            'waktu_selesai_time' => 'required_if:waktu_type,waktu|nullable|date_format:H:i',
            'waktu_selesai_text' => 'required_if:waktu_type,selesai|nullable|in:selesai',
            'deskripsi' => 'nullable|string',
        ]);

        $waktu_selesai = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        $event->update([
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')
            ->with('success', 'Event deleted successfully.');
    }
}
