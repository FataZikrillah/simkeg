<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggarans = Anggaran::with('kegiatan')->latest()->paginate(10);
        return view('page.pimpinan.anggaran.index', compact('anggarans'));
    }

    public function create()
    {
        $kegiatans = Kegiatan::all();
        return view('page.pimpinan.anggaran.create', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,disetujui',
        ]);

        Anggaran::create($request->all());

        return redirect()->route('pimpinan.anggaran.index')->with('success', 'Anggaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggaran = Anggaran::with('kegiatan')->findOrFail($id);
        return view('page.pimpinan.anggaran.show', compact('anggaran'));
    }

    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $kegiatans = Kegiatan::all();
        return view('page.pimpinan.anggaran.edit', compact('anggaran', 'kegiatans'));
    }

    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric|min:0',
            'sumber_dana' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,disetujui',
        ]);

        $anggaran->update($request->all());

        return redirect()->route('pimpinan.anggaran.index')->with('success', 'Anggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();
        return redirect()->route('pimpinan.anggaran.index')->with('success', 'Anggaran berhasil dihapus.');
    }
}
