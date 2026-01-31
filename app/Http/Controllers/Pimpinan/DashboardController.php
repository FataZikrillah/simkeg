<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Anggaran;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKegiatan = Kegiatan::count();
        $totalAnggaran = Anggaran::sum('jumlah');
        $totalLaporan = Laporan::count();

        $recentActivities = Kegiatan::latest()->take(5)->get();

        return view('page.pimpinan.dashboard', compact('totalKegiatan', 'totalAnggaran', 'totalLaporan', 'recentActivities'));
    }
}
