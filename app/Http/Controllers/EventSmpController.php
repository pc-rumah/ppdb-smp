<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\EventSmp;

class EventSmpController extends Controller
{
    public function index()
    {
        $eventsmp = EventSmp::paginate(5);
        return view('sekolah.event.index', compact('eventsmp'));
    }

    public function create()
    {
        return view('sekolah.event.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        EventSmp::create($data);

        return redirect()->route('eventsmp.index')->with('success', 'Event diajukan.');
    }


    public function edit(EventSmp $eventsmp)
    {
        return view('sekolah.event.edit', compact('eventsmp'));
    }

    public function update(EventRequest $request, EventSmp $eventsmp)
    {
        $data = $request->validated();

        $data['waktu_selesai'] = $request->waktu_type === 'waktu'
            ? $request->waktu_selesai_time
            : 'selesai';

        if (auth()->user()->hasRole('staff')) {
            $eventsmp->update([
                'previous_data' => json_encode([
                    'judul' => $eventsmp->judul,
                    'lokasi' => $eventsmp->lokasi,
                    'tanggal' => $eventsmp->tanggal,
                    'waktu_mulai' => $eventsmp->waktu_mulai,
                    'waktu_selesai' => $eventsmp->waktu_selesai,
                    'deskripsi' => $eventsmp->deskripsi,
                ]),
                'judul' => $data['judul'],
                'lokasi' => $data['lokasi'],
                'tanggal' => $data['tanggal'],
                'waktu_mulai' => $data['waktu_mulai'],
                'waktu_selesai' => $data['waktu_selesai'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'pending',
            ]);
        } else {
            $eventsmp->update(array_merge($data, [
                'status' => 'approved',
                'previous_data' => null,
            ]));
        }

        return redirect()->route('eventsmp.index')->with('success', 'Event berhasil diajukan.');
    }


    public function destroy(EventSmp $eventsmp)
    {
        if (auth()->user()->hasRole('staff')) {
            $eventsmp->update(['status' => 'pending-delete']);
            return redirect()->route('eventsmp.index')->with('success', 'Penghapusan event diajukan.');
        }

        $eventsmp->delete();
        return redirect()->route('eventsmp.index')->with('success', 'Event berhasil dihapus permanen.');
    }


    public function approval()
    {
        $eventsmp = EventSmp::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('sekolah.event.index', compact('eventsmp'));
    }

    public function approve($id)
    {
        $event = EventSmp::findOrFail($id);

        $event->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Event disetujui.');
    }

    public function reject($id)
    {
        $event = EventSmp::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($event->previous_data) {
            $old = json_decode($event->previous_data, true);
            $updateData['judul'] = $old['judul'];
            $updateData['lokasi'] = $old['lokasi'];
            $updateData['tanggal'] = $old['tanggal'];
            $updateData['waktu_mulai'] = $old['waktu_mulai'];
            $updateData['waktu_selesai'] = $old['waktu_selesai'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        $event->update($updateData);

        return back()->with('success', 'Perubahan event ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $event = EventSmp::findOrFail($id);
        $event->delete();

        return back()->with('success', 'Penghapusan event disetujui.');
    }

    public function rejectDelete($id)
    {
        $event = EventSmp::findOrFail($id);
        $event->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan event ditolak, data tetap ada.');
    }
}
