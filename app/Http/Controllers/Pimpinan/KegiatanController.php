<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::with('user');

        // Apply Filters
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('prioritas') && $request->prioritas != '') {
            $query->where('prioritas', $request->prioritas);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $kegiatans = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('page.pimpinan.kegiatan.partials.table_body', compact('kegiatans'))->render();
        }

        return view('page.pimpinan.kegiatan.index', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with(['user', 'anggaran', 'dokumentasi', 'laporan'])->findOrFail($id);
        return view('page.pimpinan.kegiatan.show', compact('kegiatan'));
    }

    public function exportPdf(Request $request)
    {
        $query = Kegiatan::with(['user', 'anggaran']);

        // Apply the same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $kegiatans = $query->latest()->get();

        $pdf = Pdf::loadView('page.pimpinan.kegiatan.export', compact('kegiatans'));

        return $pdf->download('laporan-kegiatan-' . now()->format('Y-m-d') . '.pdf');
    }
}
