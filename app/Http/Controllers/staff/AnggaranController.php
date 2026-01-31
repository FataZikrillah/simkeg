<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Staff only see budgets for their own activities
        $anggarans = Anggaran::whereHas('kegiatan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('kegiatan')->latest()->paginate(10);

        return view('page.staff.anggaran.index', compact('anggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Staff can only request budget for their own activities
        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.anggaran.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Double check ownership
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Anggaran::create([
            'kegiatan_id' => $kegiatan->id,
            'jumlah' => $request->jumlah,
            'sumber_dana' => $request->sumber_dana,
            'keterangan' => $request->keterangan,
            'status' => 'pending',
        ]);

        return redirect()->route('staff.anggaran.index')->with('success', 'Pengajuan anggaran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggaran $anggaran)
    {
        // Check ownership
        if ($anggaran->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('page.staff.anggaran.show', compact('anggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggaran $anggaran)
    {
        // Check ownership
        if ($anggaran->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allowed to edit if pending
        if ($anggaran->status !== 'pending') {
            return redirect()->route('staff.anggaran.index')->with('error', 'Anggaran yang sudah disetujui tidak dapat diubah.');
        }

        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.anggaran.edit', compact('anggaran', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggaran $anggaran)
    {
        // Check ownership
        if ($anggaran->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allowed to update if pending
        if ($anggaran->status !== 'pending') {
            return redirect()->route('staff.anggaran.index')->with('error', 'Anggaran yang sudah disetujui tidak dapat diubah.');
        }

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Check new kegiatan ownership
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $anggaran->update([
            'kegiatan_id' => $kegiatan->id,
            'jumlah' => $request->jumlah,
            'sumber_dana' => $request->sumber_dana,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('staff.anggaran.index')->with('success', 'Pengajuan anggaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggaran $anggaran)
    {
        // Check ownership
        if ($anggaran->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allowed to delete if pending
        if ($anggaran->status !== 'pending') {
            return redirect()->route('staff.anggaran.index')->with('error', 'Anggaran yang sudah disetujui tidak dapat dihapus.');
        }

        $anggaran->delete();

        return redirect()->route('staff.anggaran.index')->with('success', 'Pengajuan anggaran berhasil dibatalkan.');
    }
}
