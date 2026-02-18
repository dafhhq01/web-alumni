<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PublicGalleryController extends Controller
{
    /**
     * Display list of albums
     */
    public function index()
    {
        // Group photos by album_name
        $albums = Gallery::select('album_name', 'event_year')
            ->selectRaw('MIN(image_path) as cover_image')
            ->selectRaw('COUNT(*) as photo_count')
            ->groupBy('album_name', 'event_year')
            ->orderBy('event_year', 'desc')
            ->orderBy('album_name')
            ->get();

        return view('public.gallery.index', compact('albums'));
    }

    /**
     * Display photos in specific album
     */
    public function album($albumName)
    {
        $photos = Gallery::where('album_name', $albumName)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($photos->isEmpty()) {
            abort(404);
        }

        $albumInfo = $photos->first();

        return view('public.gallery.album', compact('photos', 'albumInfo'));
    }
}