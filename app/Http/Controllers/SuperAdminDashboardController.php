<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk Super Admin.
     */
    public function index()
    {
        // Statistik untuk Super Admin
        $stats = [
            // Menghitung jumlah user dengan role 'admin'
            'total_admins' => User::where('role', 'admin')->count(),
            
            // Statistik global sistem
            'total_alumni' => AlumniProfile::count(),
            'total_news'   => News::count(),
            'total_events' => Event::count(),
            
            // Alumni yang butuh perhatian (belum diverifikasi)
            'pending_alumni' => AlumniProfile::where('is_verified', false)->count(),
        ];

        // Opsional: Ambil daftar admin terbaru untuk ditampilkan di dashboard
        $recent_admins = User::where('role', 'admin')
            ->latest()
            ->take(5)
            ->get();

        return view('superadmin.dashboard', compact('stats', 'recent_admins'));
    }
}