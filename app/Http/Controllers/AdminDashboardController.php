<?php

namespace App\Http\Controllers;

use App\Models\AlumniProfile;
use App\Models\News; // Pastikan model ini ada
use App\Models\Event; // Pastikan model ini ada
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_alumni' => AlumniProfile::count(),
            'pending_verification' => AlumniProfile::where('is_verified', false)->count(),
            'total_news' => News::count(),
            'total_events' => Event::count(),
        ];

        // Ambil 5 alumni terbaru yang belum diverifikasi
        $latest_pending = AlumniProfile::with('user')
            ->where('is_verified', false)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_pending'));
    }
}