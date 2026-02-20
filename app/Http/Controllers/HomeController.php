<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use App\Models\AlumniProfile;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $albums = Gallery::select(
            'album_name',
            'event_year',
            DB::raw('MIN(image_path) as cover_image'),
            DB::raw('COUNT(*) as photo_count'),
            DB::raw('MAX(created_at) as last_updated') // Ambil tgl terbaru di grup ini
        )
            ->groupBy('album_name', 'event_year')
            ->orderBy('last_updated', 'desc') // Urutkan berdasarkan tgl terbaru tadi
            ->take(3)
            ->get();

        // Latest 3 published news
        $latestNews = News::published()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Upcoming 3 events
        $upcomingEvents = Event::published()
            ->upcoming()
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        // Stats
        $stats = [
            'total_alumni' => AlumniProfile::count(),
            'verified_alumni' => AlumniProfile::where('is_verified', true)->count(),
            'total_news' => News::published()->count(),
            'upcoming_events' => Event::published()->upcoming()->count(),
        ];

        return view('welcome', compact('albums','latestNews', 'upcomingEvents', 'stats'));
    }
}
