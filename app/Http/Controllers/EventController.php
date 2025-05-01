<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::paginate(5);
        return view('event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
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
            'waktu_selesai' => [
                'nullable',
                'regex:/^([01]\d|2[0-3]):[0-5]\d$|^selesai$/'
            ],
            'deskripsi' => 'string',
        ], [
            'waktu_selesai.regex' => 'Format waktu selesai harus jam (HH:mm) atau "selesai".',
        ]);

        Event::create($request->all());

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
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
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => [
                'nullable',
                'regex:/^([01]\d|2[0-3]):[0-5]\d$|^selesai$/'
            ],
            'deskripsi' => 'nullable|string',
        ], [
            'waktu_selesai.regex' => 'Format waktu selesai harus jam (HH:mm) atau "selesai".',
        ]);

        $event->update($request->all());

        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Event::findOrFail($id);

        $data->delete();
        return redirect()->route('event.index')->with('success', 'Event berhasil dihapus.');
    }
}
