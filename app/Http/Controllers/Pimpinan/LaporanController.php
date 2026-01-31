<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['kegiatan', 'user'])->latest()->paginate(10);
        return view('page.pimpinan.laporan.index', compact('laporans'));
    }

    public function create()
    {
        $kegiatans = Kegiatan::all();
        return view('page.pimpinan.laporan.create', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
            'tanggal_laporan' => 'required|date',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'disetujui'; // Pimpinan's own report is auto-approved

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('laporan', 'public');
        }

        Laporan::create($data);

        return redirect()->route('pimpinan.laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(Laporan $laporan)
    {
        return view('page.pimpinan.laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $kegiatans = Kegiatan::all();
        return view('page.pimpinan.laporan.edit', compact('laporan', 'kegiatans'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
            'tanggal_laporan' => 'required|date',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_pdf')) {
            if ($laporan->file_pdf) {
                Storage::disk('public')->delete($laporan->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('pimpinan.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->file_pdf) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }
        $laporan->delete();

        return redirect()->route('pimpinan.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $laporan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }
}
