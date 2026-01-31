<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('kegiatan')->latest()->get();
        $totalFiles = Dokumentasi::count();
        $totalActivities = Kegiatan::has('dokumentasi')->count();

        // Calculate counts for different file types
        $imageCount = Dokumentasi::where(function ($query) {
            $query->where('file', 'like', '%.jpg')
                ->orWhere('file', 'like', '%.jpeg')
                ->orWhere('file', 'like', '%.png')
                ->orWhere('file', 'like', '%.gif')
                ->orWhere('file', 'like', '%.webp');
        })->count();

        $pdfCount = Dokumentasi::where('file', 'like', '%.pdf')->count();

        $docCount = Dokumentasi::where(function ($query) {
            $query->where('file', 'like', '%.doc')
                ->orWhere('file', 'like', '%.docx')
                ->orWhere('file', 'like', '%.xls')
                ->orWhere('file', 'like', '%.xlsx');
        })->count();

        $otherCount = $totalFiles - ($imageCount + $pdfCount + $docCount);

        return view('page.admin.dokumentasi.index', compact(
            'dokumentasi',
            'totalFiles',
            'totalActivities',
            'imageCount',
            'pdfCount',
            'docCount',
            'otherCount'
        ));
    }

    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('page.admin.dokumentasi.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'file' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
            $validated['file'] = $path;
        }

        Dokumentasi::create($validated);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $dokumentasi = Dokumentasi::with('kegiatan')->findOrFail($id);
        return view('page.admin.dokumentasi.show', compact('dokumentasi'));
    }

    public function edit($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        $kegiatan = Kegiatan::all();
        return view('page.admin.dokumentasi.edit', compact('dokumentasi', 'kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatan,id',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $dokumentasi = Dokumentasi::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($dokumentasi->file) {
                Storage::disk('public')->delete($dokumentasi->file);
            }
            $path = $request->file('file')->store('dokumentasi', 'public');
            $validated['file'] = $path;
        }

        $dokumentasi->update($validated);

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        if ($dokumentasi->file) {
            Storage::disk('public')->delete($dokumentasi->file);
        }
        $dokumentasi->delete();

        return redirect()->route('admin.dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus');
    }
}
