<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramPondok;
use Illuminate\Support\Facades\Storage;

class ProgramPondokController extends Controller
{
    public function index()
    {
        $data = ProgramPondok::paginate(5);
        return view('manage3landing.pondok.program.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.pondok.program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_program', 'public');
        }

        $validated['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        ProgramPondok::create($validated);

        return redirect()->route('programpondok.index')->with('success', 'Program diajukan.');
    }

    public function edit(string $id)
    {
        $data = ProgramPondok::find($id);
        return view('manage3landing.pondok.program.edit', compact('data'));
    }

    public function update(Request $request, ProgramPondok $programpondok)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama']);
        $fotoBaru = null;

        if ($request->hasFile('foto')) {
            $fotoBaru = $request->file('foto')->store('foto_program', 'public');
        }

        if (auth()->user()->hasRole('pondok')) {
            $programpondok->update([
                'previous_data' => json_encode([
                    'nama' => $programpondok->nama,
                    'foto' => $programpondok->foto,
                ]),
                'nama' => $data['nama'],
                'foto' => $fotoBaru ?? $programpondok->foto,
                'status' => 'pending',
            ]);
        } else {
            if ($fotoBaru) {
                if ($programpondok->foto && Storage::disk('public')->exists($programpondok->foto)) {
                    Storage::disk('public')->delete($programpondok->foto);
                }
                $data['foto'] = $fotoBaru;
            } else {
                $data['foto'] = $programpondok->foto;
            }

            $programpondok->update(array_merge($data, [
                'status' => 'approved',
                'previous_data' => null,
            ]));
        }

        return redirect()->route('programpondok.index')->with('success', 'Program diajukan.');
    }

    public function destroy(ProgramPondok $programpondok)
    {
        if ($programpondok->kategori()->exists()) {
            return redirect()->route('programpondok.index')
                ->with('error', 'Data tidak bisa dihapus karena masih digunakan oleh Item Program.');
        }

        if (auth()->user()->hasRole('pondok')) {
            $programpondok->update(['status' => 'pending-delete']);
            return redirect()->route('programpondok.index')->with('success', 'Permintaan hapus diajukan.');
        }

        if ($programpondok->foto && Storage::disk('public')->exists($programpondok->foto)) {
            Storage::disk('public')->delete($programpondok->foto);
        }

        $programpondok->delete();
        return redirect()->route('programpondok.index')->with('success', 'Program berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = ProgramPondok::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.pondok.program.index', compact('data'));
    }

    public function approve($id)
    {
        $program = ProgramPondok::findOrFail($id);

        $program->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Program disetujui.');
    }

    public function reject($id)
    {
        $program = ProgramPondok::findOrFail($id);

        if ($program->previous_data) {
            $old = json_decode($program->previous_data, true);

            $program->update([
                'nama' => $old['nama'],
                'foto' => $old['foto'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        } else {
            $program->update(['status' => 'approved']);
        }

        return back()->with('success', 'Perubahan ditolak, data program dikembalikan.');
    }

    public function approveDelete($id)
    {
        $program = ProgramPondok::findOrFail($id);

        if ($program->foto && Storage::disk('public')->exists($program->foto)) {
            Storage::disk('public')->delete($program->foto);
        }

        $program->delete();

        return back()->with('success', 'Penghapusan program disetujui.');
    }

    public function rejectDelete($id)
    {
        $program = ProgramPondok::findOrFail($id);
        $program->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan program ditolak, data tetap ada.');
    }
}
