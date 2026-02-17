<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniProfileController extends Controller
{
    public function show()
    {
        return view('alumni.profile');
    }

    public function complete()
    {
        return view('alumni.complete-profile');
    }

    public function storeComplete(Request $request)
    {
        // Akan diisi di Hari 2
        return redirect()->route('alumni.profile');
    }

    public function edit()
    {
        return view('alumni.edit-profile');
    }

    public function update(Request $request)
    {
        return redirect()->route('alumni.profile');
    }

    public function uploadPicture(Request $request)
    {
        return redirect()->route('alumni.profile');
    }

    public function togglePrivacy(Request $request)
    {
        return redirect()->route('alumni.profile');
    }
}