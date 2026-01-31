<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::with('user')
            ->where('user_id', Auth::id());

        // Fillter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Prioritas
        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        // Filter Rentang Tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $kegiatans = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('page.staff.kegiatan._table', compact('kegiatans'))->render();
        }

        return view('page.staff.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('page.staff.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable',
            'lokasi' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        $kegiatan = Kegiatan::create($validated);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
            $kegiatan->dokumentasi()->create([
                'file' => $path,
                'keterangan' => 'Lampiran awal: ' . $kegiatan->judul,
            ]);
        }

        return redirect()->route('staff.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with(['user', 'anggaran', 'dokumentasi', 'laporan'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('page.staff.kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::where('user_id', Auth::id())->findOrFail($id);
        return view('page.staff.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'nullable',
            'lokasi' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'status' => 'required|string',
        ]);

        $kegiatan = Kegiatan::where('user_id', Auth::id())->findOrFail($id);
        $kegiatan->update($validated);

        return redirect()->route('staff.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::where('user_id', Auth::id())->findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('staff.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
