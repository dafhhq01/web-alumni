<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class PublicDonationController extends Controller
{
    /**
     * Display active donation campaigns
     */
    public function index()
    {
        $donations = Donation::active()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.donations.index', compact('donations'));
    }
}