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
        $albums = Gallery::select('album_name', 'event_year')
            ->selectRaw('MIN(image_path) as cover_image')
            ->selectRaw('COUNT(*) as photo_count')
            ->groupBy('album_name', 'event_year')
            ->orderBy('event_year', 'desc')
            ->orderBy('album_name')
            ->get();

        // SESUAIKAN: Gunakan folder 'galleries' (sesuai folder fisik kamu)
        return view('public.galleries.index', compact('albums'));
    }

    /**
     * Display photos in specific album
     */
    public function album($album_name)
    {
        $decodedName = urldecode($album_name);
        $photos = \App\Models\Gallery::where('album_name', $decodedName)->get();

        if ($photos->isEmpty()) {
            abort(404, 'Album tidak ditemukan');
        }

        $albumInfo = $photos->first();

        // SESUAIKAN: Harus sama jalurnya dengan index (folder 'galleries')
        return view('public.galleries.album', compact('photos', 'albumInfo'));
    }
}
