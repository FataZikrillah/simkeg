<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Staff only see reports for their own activities
        $laporans = Laporan::whereHas('kegiatan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('kegiatan')->latest()->paginate(10);

        return view('page.staff.laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Staff can only create reports for their own activities
        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.laporan.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Double check ownership
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Add user_id if needed by model/logic
        $data['status'] = 'pending';

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('laporan', 'public');
        }

        Laporan::create($data);

        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil dikirim dan menunggu persetujuan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        // Check ownership
        if ($laporan->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('page.staff.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        // Check ownership
        if ($laporan->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allowed to edit if pending or rejected (to allow resubmission)
        if ($laporan->status === 'disetujui') {
            return redirect()->route('staff.laporan.index')->with('error', 'Laporan yang sudah disetujui tidak dapat diubah.');
        }

        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.laporan.edit', compact('laporan', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        // Check ownership
        if ($laporan->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($laporan->status === 'disetujui') {
            return redirect()->route('staff.laporan.index')->with('error', 'Laporan yang sudah disetujui tidak dapat diubah.');
        }

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // If it was rejected, set it back to pending on update
        if ($laporan->status === 'ditolak') {
            $data['status'] = 'pending';
        }

        if ($request->hasFile('file_pdf')) {
            // Delete old file
            if ($laporan->file_pdf) {
                Storage::disk('public')->delete($laporan->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        // Check ownership
        if ($laporan->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($laporan->status === 'disetujui') {
            return redirect()->route('staff.laporan.index')->with('error', 'Laporan yang sudah disetujui tidak dapat dihapus.');
        }

        if ($laporan->file_pdf) {
            Storage::disk('public')->delete($laporan->file_pdf);
        }

        $laporan->delete();

        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
