<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;

class PublicAlumniController extends Controller
{
    /**
     * Display alumni directory with search and filter
     */
    public function index(Request $request)
    {
        $query = AlumniProfile::with('user')
            ->where('is_verified', true)
            ->where('is_private', false);

        // Search by name
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter by angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter by graduation year
        if ($request->filled('graduation_year')) {
            $query->where('graduation_year', $request->graduation_year);
        }

        $alumni = $query->orderBy('full_name')->paginate(12);

        // Get unique values for filters
        $angkatanList = AlumniProfile::where('is_verified', true)
            ->where('is_private', false)
            ->whereNotNull('angkatan')
            ->distinct()
            ->pluck('angkatan')
            ->sort()
            ->values();

        $graduationYears = AlumniProfile::where('is_verified', true)
            ->where('is_private', false)
            ->whereNotNull('graduation_year')
            ->distinct()
            ->pluck('graduation_year')
            ->sort()
            ->values();

        return view('public.alumni.index', compact('alumni', 'angkatanList', 'graduationYears'));
    }

    /**
     * Display single alumni profile
     */
    public function show($id)
    {
        $profile = AlumniProfile::with('user')
            ->where('id', $id)
            ->where('is_verified', true)
            ->where('is_private', false)
            ->firstOrFail();

        return view('public.alumni.show', compact('profile'));
    }
}