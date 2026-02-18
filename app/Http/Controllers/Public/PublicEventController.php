<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    /**
     * Display list of published events
     */
    public function index(Request $request)
    {
        $query = Event::with('author')->published();

        // Filter: upcoming or past
        if ($request->filter === 'upcoming') {
            $query->upcoming();
        } elseif ($request->filter === 'past') {
            $query->where('event_date', '<', now()->toDateString());
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(9);

        return view('public.events.index', compact('events'));
    }

    /**
     * Display single event detail
     */
    public function show($slug)
    {
        $event = Event::with('author')->published()->where('slug', $slug)->firstOrFail();

        // Get related events (upcoming events, exclude current)
        $relatedEvents = Event::published()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        return view('public.events.show', compact('event', 'relatedEvents'));
    }
}