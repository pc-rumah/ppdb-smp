<?php

namespace App\Http\Controllers;

use App\Models\ProgramMadrasah;
use Illuminate\Http\Request;

class ProgramMadrasahController extends Controller
{
    public function index()
    {
        $data = ProgramMadrasah::paginate(5);
        return view('manage3landing.madrasah.program.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        ProgramMadrasah::create([
            'title' => $request->nama,
            'description' => $request->description,
            'icon' => $request->icon,
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('programmadrasah.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $data = ProgramMadrasah::find($id);
        return view('manage3landing.madrasah.program.edit', compact('data'));
    }

    public function update(Request $request, ProgramMadrasah $programmadrasah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
        ]);

        if (auth()->user()->hasRole('madrasah')) {
            $programmadrasah->update([
                'previous_data' => json_encode([
                    'title' => $programmadrasah->title,
                    'description' => $programmadrasah->description,
                    'icon' => $programmadrasah->icon,
                ]),
                'title' => $request->nama,
                'description' => $request->description,
                'icon' => $request->icon,
                'status' => 'pending',
            ]);
        } else {
            $programmadrasah->update([
                'title' => $request->nama,
                'description' => $request->description,
                'icon' => $request->icon,
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('programmadrasah.index')->with('success', 'Perubahan program berhasil diajukan.');
    }

    public function destroy(ProgramMadrasah $programmadrasah)
    {
        if (auth()->user()->hasRole('madrasah')) {
            $programmadrasah->update([
                'status' => 'pending-delete',
            ]);

            return redirect()->route('programmadrasah.index')->with('success', 'Penghapusan program diajukan');
        }

        if (auth()->user()->hasRole('master-admin')) {
            $programmadrasah->delete();
            return redirect()->route('programmadrasah.index')->with('success', 'Program berhasil dihapus permanen.');
        }
    }

    public function approval()
    {
        $data = ProgramMadrasah::whereIn('status', ['pending', 'pending-delete'])->get();
        return view('manage3landing.madrasah.program.index', compact('data'));
    }

    public function approve($id)
    {
        $program = ProgramMadrasah::findOrFail($id);

        $program->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Program berhasil disetujui.');
    }

    public function reject($id)
    {
        $program = ProgramMadrasah::findOrFail($id);

        if ($program->previous_data) {
            $old = json_decode($program->previous_data, true);

            $program->update([
                'title' => $old['title'],
                'description' => $old['description'],
                'icon' => $old['icon'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        } else {
            $program->update(['status' => 'approved']);
        }

        return back()->with('success', 'Perubahan ditolak, data dikembalikan ke versi sebelumnya.');
    }

    public function approveDelete($id)
    {
        $program = ProgramMadrasah::findOrFail($id);
        $program->delete();

        return back()->with('success', 'Penghapusan program berhasil disetujui.');
    }

    public function rejectDelete($id)
    {
        $program = ProgramMadrasah::findOrFail($id);
        $program->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Penghapusan program ditolak, data dikembalikan.');
    }
}
