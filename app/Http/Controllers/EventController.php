<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        Event::create($data);

        Cache::forget('landing_event');

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu' ? $request->waktu_selesai_time : 'selesai';

        $event->update($data);

        Cache::forget('landing_event');

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        Cache::forget('landing_event');

        return redirect()->route('event.index')
            ->with('success', 'Event deleted successfully.');
    }
}
