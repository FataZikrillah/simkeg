<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggarans = Anggaran::with('kegiatan')->latest()->paginate(10);
        $totalBudget = Anggaran::sum('jumlah');

        $approvedBudget = Anggaran::where('status', 'disetujui')->sum('jumlah');
        $pendingBudget = Anggaran::where('status', 'pending')->sum('jumlah');
        $rejectedBudget = Anggaran::where('status', 'ditolak')->sum('jumlah');

        $approvedPercentage = $totalBudget > 0 ? ($approvedBudget / $totalBudget) * 100 : 0;
        $pendingPercentage = $totalBudget > 0 ? ($pendingBudget / $totalBudget) * 100 : 0;
        $rejectedPercentage = $totalBudget > 0 ? ($rejectedBudget / $totalBudget) * 100 : 0;

        $budgetBySource = Anggaran::select('sumber_dana')
            ->selectRaw('count(*) as count')
            ->selectRaw('sum(jumlah) as total')
            ->groupBy('sumber_dana')
            ->get();

        return view('page.admin.anggaran.index', compact(
            'anggarans',
            'totalBudget',
            'approvedBudget',
            'pendingBudget',
            'rejectedBudget',
            'approvedPercentage',
            'pendingPercentage',
            'rejectedPercentage',
            'budgetBySource'
        ));
    }

    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('page.admin.anggaran.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric',
            'sumber_dana' => 'required|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Anggaran::create($validated);

        return redirect()->route('admin.anggaran.index')->with('success', 'Anggaran berhasil ditambahkan');
    }

    public function show($id)
    {
        $anggaran = Anggaran::with('kegiatan')->findOrFail($id);
        return view('page.admin.anggaran.show', compact('anggaran'));
    }

    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $kegiatan = Kegiatan::all();
        return view('page.admin.anggaran.edit', compact('anggaran', 'kegiatan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jumlah' => 'required|numeric',
            'sumber_dana' => 'required|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update($validated);

        return redirect()->route('admin.anggaran.index')->with('success', 'Anggaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return redirect()->route('admin.anggaran.index')->with('success', 'Anggaran berhasil dihapus');
    }
}
