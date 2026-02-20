<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::with('author')->latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $news = new News($validated);
        $news->created_by = Auth::id();
        $news->is_published = $request->has('publish');

        if ($request->hasFile('image')) {
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $news->fill($validated);
        $news->is_published = $request->has('publish');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Hapus file gambar dari storage sebelum datanya dihapus permanen
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        // Menggunakan forceDelete karena permintaan user (hapus permanen dari DB)
        $news->forceDelete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted permanently!');
    }
}