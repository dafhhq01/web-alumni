<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        // Mengambil galeri, urutkan berdasarkan tahun terbaru dan input terbaru
        $galleries = Gallery::with('uploader')
            ->orderBy('event_year', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'event_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Mendukung multiple upload
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('galleries', 'public');

                Gallery::create([
                    'album_name' => $request->album_name,
                    'event_year' => $request->event_year,
                    'image_path' => $path,
                    'uploaded_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'album_name' => 'required|string|max:255',
            'event_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('galleries', 'public');
            $gallery->image_path = $path;
        }

        $gallery->album_name = $request->album_name;
        $gallery->event_year = $request->event_year;
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Data galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // 1. Hapus file fisik dari storage
        if (Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        // 2. Force Delete (Hapus permanen dari database)
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus secara permanen.');
    }
}
