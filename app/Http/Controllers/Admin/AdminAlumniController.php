<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AdminAlumniController extends Controller
{
    /**
     * Menampilkan daftar semua alumni dengan fitur filter & search
     */
    public function index(Request $request)
    {
        $query = AlumniProfile::with('user');

        // Filter: Pencarian Nama
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Filter: Status Verifikasi (1 = verified, 0 = pending)
        if ($request->filled('status')) {
            $status = $request->status === 'verified' ? 1 : 0;
            $query->where('is_verified', $status);
        }

        // Filter UMKM
        if ($request->filled('business_only')) {
            $query->where('has_business', true);
        }

        // Urutkan: Pending verifikasi di atas, lalu yang terbaru
        $alumni = $query->orderBy('is_verified', 'asc')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.alumni.index', compact('alumni'));
    }

    /**
     * Menampilkan detail lengkap satu alumni
     */
    public function show($id)
    {
        $alumnus = AlumniProfile::with('user')->findOrFail($id);
        return view('admin.alumni.show', compact('alumnus'));
    }

    /**
     * Form edit data alumni oleh admin
     */
    public function edit($id)
    {
        $alumnus = AlumniProfile::findOrFail($id);
        return view('admin.alumni.edit', compact('alumnus'));
    }

    /**
     * Update data alumni oleh admin
     */
    public function update(Request $request, $id)
    {
        $profile = AlumniProfile::findOrFail($id);

        $validated = $request->validate([
            'full_name'       => 'required|string|max:255',
            'angkatan'        => 'nullable|string|max:10',
            'graduation_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'phone_number'    => 'nullable|string|max:20',
            'current_job'     => 'nullable|string|max:255',
            'company'         => 'nullable|string|max:255',
            'address'         => 'nullable|string', // Pastikan address divalidasi
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'has_business'    => 'required|in:0,1',
            'business_name'   => 'nullable|required_if:has_business,1|string|max:255',
            'business_type'   => 'nullable|string|max:100',
            'business_description' => 'nullable|string',
            'business_photo'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'social_instagram' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_facebook' => 'nullable|url',
            'social_twitter'  => 'nullable|url',
        ]);

        // 1. Handle Update Foto Profil
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($profile->profile_picture_path) {
                Storage::disk('public')->delete($profile->profile_picture_path);
            }

            $file = $request->file('profile_picture');
            $filename = 'profile_' . $profile->user_id . '_' . time() . '.' . $file->extension();

            // Simpan manual atau gunakan Intervention Image (jika library sudah siap)
            // Disini saya gunakan store standar agar konsisten dengan business_photo
            $path = $file->storeAs('profiles', $filename, 'public');
            $profile->profile_picture_path = $path;
        }

        // 2. Handle Update Foto Bisnis
        if ($request->hasFile('business_photo')) {
            if ($profile->business_photo) {
                Storage::disk('public')->delete($profile->business_photo);
            }
            $profile->business_photo = $request->file('business_photo')->store('umkm', 'public');
        }

        // 3. Handle Social Media (Gabungkan ke JSON)
        $socialMediaLinks = array_filter([
            'instagram' => $request->social_instagram,
            'linkedin'  => $request->social_linkedin,
            'facebook'  => $request->social_facebook,
            'twitter'   => $request->social_twitter,
        ]);
        $profile->social_media_links = !empty($socialMediaLinks) ? $socialMediaLinks : null;

        // 4. Update Field Lainnya
        $profile->full_name = $validated['full_name'];
        $profile->angkatan = $validated['angkatan'];
        $profile->graduation_year = $validated['graduation_year'];
        $profile->phone_number = $validated['phone_number'];
        $profile->current_job = $validated['current_job'];
        $profile->company = $validated['company'];
        $profile->address = $validated['address']; // Update Address
        $profile->has_business = (bool) $validated['has_business'];
        $profile->business_name = $validated['business_name'];
        $profile->business_type = $validated['business_type'];
        $profile->business_description = $validated['business_description'];

        $profile->save();

        return redirect()->route('admin.alumni.index')
            ->with('success', "Data {$profile->full_name} berhasil diperbarui.");
    }

    /**
     * Memverifikasi alumni (Set is_verified = 1)
     */
    public function verify($id)
    {
        $profile = AlumniProfile::findOrFail($id);
        $profile->update(['is_verified' => true]);

        return back()->with('success', "Alumni {$profile->full_name} telah diverifikasi.");
    }

    /**
     * Membatalkan verifikasi (Set is_verified = 0)
     */
    public function unverify($id)
    {
        $profile = AlumniProfile::findOrFail($id);
        $profile->update(['is_verified' => false]);

        return back()->with('info', "Verifikasi {$profile->full_name} telah dicabut.");
    }

    /**
     * Menghapus alumni dan akun user-nya
     */
    public function destroy($id)
    {
        $profile = AlumniProfile::withTrashed()->with('user')->findOrFail($id);

        $user = $profile->user;

        // Hapus Profil secara PERMANEN (menghapus dari baris database)
        $profile->forceDelete();

        // Hapus User secara PERMANEN jika ada
        if ($user) {
            if (method_exists($user, 'forceDelete')) {
                $user->forceDelete();
            } else {
                $user->delete();
            }
        }

        return back()->with('success', 'Akun alumni dan seluruh datanya telah dihapus permanen dari sistem.');
    }

    // Mengexport data ke excel

    public function export(Request $request)
    {
        $ids = $request->input('ids'); // Mengambil array ID dari checkbox
        $selectedIds = $ids ? explode(',', $ids) : null;

        return Excel::download(new AlumniExport($selectedIds), 'data_alumni_' . date('Y-m-d') . '.xlsx');
    }
}
