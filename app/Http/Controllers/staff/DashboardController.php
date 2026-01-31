<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Anggaran;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalKegiatan = Kegiatan::where('user_id', $userId)->count();
        $totalAnggaran = Anggaran::whereHas('kegiatan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->sum('jumlah');
        $totalLaporan = Laporan::whereHas('kegiatan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $kegiatanDisetujui = Kegiatan::where('user_id', $userId)->where('status', 'disetujui')->count();
        $kegiatanDraft = Kegiatan::where('user_id', $userId)->where('status', 'draft')->count();

        $recentActivities = Kegiatan::where('user_id', $userId)->latest()->take(5)->get();

        return view('page.staff.dashboard', compact(
            'totalKegiatan',
            'totalAnggaran',
            'totalLaporan',
            'kegiatanDisetujui',
            'kegiatanDraft',
            'recentActivities'
        ));
    }
}
