<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Staff only see documentation for their own activities
        $dokumentasis = Dokumentasi::whereHas('kegiatan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with('kegiatan')->latest()->paginate(12);

        return view('page.staff.dokumentasi.index', compact('dokumentasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Staff can only add documentation to their own activities
        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.dokumentasi.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB per image
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Check ownership of the kegiatan
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('dokumentasi', 'public');

                Dokumentasi::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file' => $path,
                    'keterangan' => $request->keterangan,
                ]);
            }
            return redirect()->route('staff.dokumentasi.index')->with('success', 'Dokumentasi berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah file.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumentasi $dokumentasi)
    {
        // Check ownership
        if ($dokumentasi->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        $kegiatans = Kegiatan::where('user_id', Auth::id())->get();
        return view('page.staff.dokumentasi.edit', compact('dokumentasi', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        // Check ownership
        if ($dokumentasi->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Check new kegiatan ownership
        $kegiatan = Kegiatan::where('id', $request->kegiatan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = [
            'kegiatan_id' => $kegiatan->id,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($dokumentasi->file) {
                Storage::disk('public')->delete($dokumentasi->file);
            }
            $data['file'] = $request->file('file')->store('dokumentasi', 'public');
        }

        $dokumentasi->update($data);

        return redirect()->route('staff.dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        // Check ownership
        if ($dokumentasi->kegiatan->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete file from storage
        if ($dokumentasi->file) {
            Storage::disk('public')->delete($dokumentasi->file);
        }

        $dokumentasi->delete();

        return redirect()->route('staff.dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
