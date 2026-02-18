<?php

namespace App\Http\Controllers;

use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AlumniProfileController extends Controller
{
    /**
     * Show alumni profile
     */
    public function show()
    {
        $profile = auth()->user()->alumniProfile;

        // Jika belum ada profil, redirect ke complete profile
        if (!$profile) {
            return redirect()->route('alumni.profile.complete');
        }

        return view('alumni.profile', compact('profile'));
    }

    /**
     * Show complete profile form (first time)
     */
    public function complete()
    {
        // Jika sudah punya profil, redirect ke profile
        if (auth()->user()->alumniProfile) {
            return redirect()->route('alumni.profile');
        }

        return view('alumni.complete-profile');
    }

    /**
     * Store complete profile (first time)
     */
    public function storeComplete(Request $request)
    {
        $validated = $request->validate([
            'full_name'         => 'required|string|max:255',
            'angkatan'          => 'nullable|string|max:10',
            'graduation_year'   => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'phone_number'      => 'nullable|string|max:20',
            'current_job'       => 'nullable|string|max:255',
            'company'           => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'social_instagram'  => 'nullable|url',
            'social_linkedin'   => 'nullable|url',
            'social_facebook'   => 'nullable|url',
            'social_twitter'    => 'nullable|url',
            'has_business'      => 'required|in:0,1',
            'business_name'     => 'nullable|required_if:has_business,1|string|max:255',
            'business_type'     => 'nullable|string|max:100',
            'business_description' => 'nullable|string',
            'business_photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Upload Foto Bisnis
        $businessPhotoPath = null;
        if ($request->hasFile('business_photo')) {
            $businessPhotoPath = $request->file('business_photo')->store('umkm', 'public');
        }

        // Gabungkan social media links ke JSON
        $socialMediaLinks = [
            'instagram' => $request->social_instagram,
            'linkedin'  => $request->social_linkedin,
            'facebook'  => $request->social_facebook,
            'twitter'   => $request->social_twitter,
        ];

        // Filter yang kosong
        $socialMediaLinks = array_filter($socialMediaLinks);

        AlumniProfile::create([
            'user_id'            => auth()->id(),
            'full_name'          => $validated['full_name'],
            'angkatan'           => $validated['angkatan'] ?? null,
            'graduation_year'    => $validated['graduation_year'] ?? null,
            'phone_number'       => $validated['phone_number'] ?? null,
            'current_job'        => $validated['current_job'] ?? null,
            'company'            => $validated['company'] ?? null,
            'address'            => $validated['address'] ?? null,
            'social_media_links' => !empty($socialMediaLinks) ? $socialMediaLinks : null,
            'has_business'       => (bool) $validated['has_business'],
            'business_name'      => $validated['business_name'],
            'business_type'      => $validated['business_type'],
            'business_description' => $validated['business_description'],
            'business_photo'     => $businessPhotoPath,
        ]);

        return redirect()->route('alumni.profile')->with('success', 'Profile completed successfully!');
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        $profile = auth()->user()->alumniProfile;

        if (!$profile) {
            return redirect()->route('alumni.profile.complete');
        }

        return view('alumni.edit-profile', compact('profile'));
    }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        $profile = auth()->user()->alumniProfile;

        if (!$profile) {
            return redirect()->route('alumni.profile.complete');
        }

        $validated = $request->validate([
            'full_name'         => 'required|string|max:255',
            'angkatan'          => 'nullable|string|max:10',
            'graduation_year'   => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'phone_number'      => 'nullable|string|max:20',
            'current_job'       => 'nullable|string|max:255',
            'company'           => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'social_instagram'  => 'nullable|url',
            'social_linkedin'   => 'nullable|url',
            'social_facebook'   => 'nullable|url',
            'social_twitter'    => 'nullable|url',
            'has_business'      => 'required|in:0,1',
            'business_name'     => 'nullable|required_if:has_business,1|string|max:255',
            'business_type'     => 'nullable|string|max:100',
            'business_description' => 'nullable|string',
            'business_photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update Field Standar
        $profile->full_name = $validated['full_name'];
        $profile->angkatan = $validated['angkatan'];
        $profile->graduation_year = $validated['graduation_year'];
        $profile->phone_number = $validated['phone_number'];
        $profile->current_job = $validated['current_job'];
        $profile->company = $validated['company'];
        $profile->address = $validated['address'];
        $profile->has_business = (bool) $validated['has_business'];
        $profile->business_name = $validated['business_name'];
        $profile->business_type = $validated['business_type'];
        $profile->business_description = $validated['business_description'];

        // Handle Foto Bisnis Baru
        if ($request->hasFile('business_photo')) {
            if ($profile->business_photo) {
                Storage::disk('public')->delete($profile->business_photo);
            }
            $profile->business_photo = $request->file('business_photo')->store('umkm', 'public');
        }

        // Handle Social Media
        $socialMediaLinks = array_filter([
            'instagram' => $request->social_instagram,
            'linkedin'  => $request->social_linkedin,
            'facebook'  => $request->social_facebook,
            'twitter'   => $request->social_twitter,
        ]);
        $profile->social_media_links = !empty($socialMediaLinks) ? $socialMediaLinks : null;

        $profile->save();

        return redirect()->route('alumni.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Upload profile picture
     */
    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = auth()->user()->alumniProfile;

        if (!$profile) {
            return back()->with('error', 'Please complete your profile first.');
        }

        // Hapus foto lama jika ada
        if ($profile->profile_picture_path) {
            Storage::disk('public')->delete($profile->profile_picture_path);
        }

        // Upload dan resize foto baru
        $file = $request->file('profile_picture');
        $filename = 'profile_' . auth()->id() . '_' . time() . '.' . $file->extension();

        // Resize menggunakan Intervention Image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->cover(400, 400); // Crop to square 400x400

        // Simpan ke storage
        $path = 'profiles/' . $filename;
        Storage::disk('public')->put($path, $image->encode());

        // Update database
        $profile->update([
            'profile_picture_path' => $path,
        ]);

        return back()->with('success', 'Profile picture uploaded successfully!');
    }

    /**
     * Toggle privacy setting
     */
    public function togglePrivacy()
    {
        $profile = auth()->user()->alumniProfile;

        if (!$profile) {
            return back()->with('error', 'Please complete your profile first.');
        }

        $profile->update([
            'is_private' => !$profile->is_private,
        ]);

        $status = $profile->is_private ? 'hidden from' : 'visible in';

        return back()->with('success', "Your profile is now {$status} the alumni directory.");
    }
}