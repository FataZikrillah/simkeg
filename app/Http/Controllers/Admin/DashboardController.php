<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Anggaran;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch stats for the dashboard
        $totalKegiatan = Kegiatan::count();
        $totalAnggaran = Anggaran::sum('jumlah'); // Assuming 'jumlah' is the amount column
        $totalLaporan = Laporan::count();

        // Fetch recent activities
        $recentActivities = Kegiatan::latest()->take(5)->get();

        return view('page.admin.dashboard', compact('totalKegiatan', 'totalAnggaran', 'totalLaporan', 'recentActivities'));
    }
}
