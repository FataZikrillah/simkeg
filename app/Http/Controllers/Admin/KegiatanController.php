<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('user')->latest()->paginate(10);
        $totalKegiatan = Kegiatan::count();
        $pendingKegiatan = Kegiatan::where('status', 'pending')->count();
        $disetujuiKegiatan = Kegiatan::where('status', 'disetujui')->count();
        $ditolakKegiatan = Kegiatan::where('status', 'ditolak')->count();

        return view('page.admin.data kegiatan.index', compact(
            'kegiatans',
            'totalKegiatan',
            'pendingKegiatan',
            'disetujuiKegiatan',
            'ditolakKegiatan'
        ));
    }

    public function create()
    {
        $users = User::all();
        return view('page.admin.data kegiatan.create', compact('users'));
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
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('kegiatan_images', 'public');
        }

        $kegiatan = Kegiatan::create($validated);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
            $kegiatan->dokumentasi()->create([
                'file' => $path,
                'keterangan' => 'Lampiran awal: ' . $kegiatan->judul,
            ]);
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with(['user', 'anggaran', 'dokumentasi', 'laporan'])->findOrFail($id);
        return view('page.admin.data kegiatan.show', compact('kegiatan'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $users = User::all();
        return view('page.admin.data kegiatan.edit', compact('kegiatan', 'users'));
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
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('kegiatan_images', 'public');
        }

        $kegiatan->update($validated);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
            $kegiatan->dokumentasi()->create([
                'file' => $path,
                'keterangan' => 'Lampiran tambahan: ' . $kegiatan->judul,
            ]);
        }

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }

    public function export($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        // For now, redirect back with a message as actual PDF export is not implemented
        return redirect()->back()->with('warning', 'Fitur Export PDF sedang dalam pengembangan');
    }
}
