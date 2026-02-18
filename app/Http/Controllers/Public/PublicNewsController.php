<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class PublicNewsController extends Controller
{
    /**
     * Display list of published news
     */
    public function index(Request $request)
    {
        $query = News::with('author')->published();

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(9);

        // Get unique categories for filter
        $categories = News::published()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        return view('public.news.index', compact('news', 'categories'));
    }

    /**
     * Display single news detail
     */
    public function show($slug)
    {
        $news = News::with('author')->published()->where('slug', $slug)->firstOrFail();

        // Get related news (same category, exclude current)
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->when($news->category, function ($query) use ($news) {
                $query->where('category', $news->category);
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('public.news.show', compact('news', 'relatedNews'));
    }
}