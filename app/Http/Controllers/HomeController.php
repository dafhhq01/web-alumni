<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('welcome', compact('latestNews', 'upcomingEvents', 'stats'));
    }
}