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
        $validated = $request->validate([
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

        Event::create($validated);

        return redirect()->route('event.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
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

        $event->update($validated);

        return redirect()->route('event.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('event.index')
            ->with('success', 'Event deleted successfully.');
    }
}
