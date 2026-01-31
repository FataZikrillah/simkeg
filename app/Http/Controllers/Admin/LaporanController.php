<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('kegiatan')->latest()->get();
        $totalReports = Laporan::count();
        $approvedReports = Laporan::where('status', 'approved')->count();
        $pendingReports = Laporan::where('status', 'pending')->count();
        $rejectedReports = Laporan::where('status', 'rejected')->count();

        $approvedPercentage = $totalReports > 0 ? ($approvedReports / $totalReports) * 100 : 0;
        $pendingPercentage = $totalReports > 0 ? ($pendingReports / $totalReports) * 100 : 0;
        $rejectedPercentage = $totalReports > 0 ? ($rejectedReports / $totalReports) * 100 : 0;

        return view('page.admin.laporan.index', compact(
            'laporan',
            'totalReports',
            'approvedReports',
            'pendingReports',
            'rejectedReports',
            'approvedPercentage',
            'pendingPercentage',
            'rejectedPercentage'
        ));
    }

    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('page.admin.laporan.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('laporan', 'public');
            $validated['file_pdf'] = $path;
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';
        $validated['tanggal_laporan'] = now();

        Laporan::create($validated);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function show($id)
    {
        $laporan = Laporan::with('kegiatan', 'user')->findOrFail($id);
        return view('page.admin.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        $kegiatan = Kegiatan::all();
        return view('page.admin.laporan.edit', compact('laporan', 'kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($laporan->file_pdf) {
                Storage::disk('public')->delete($laporan->file_pdf);
            }
            $path = $request->file('file')->store('laporan', 'public');
            $validated['file_pdf'] = $path;
        }

        $laporan->update($validated);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->file_pdf) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
