<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('author')->orderBy('event_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'title' => $request->title,
            'content' => $request->content,
            'event_date' => $request->event_date,
            'image_path' => $imagePath,
            'is_published' => $request->has('publish'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'event_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $event->image_path = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $request->title,
            'content' => $request->content,
            'event_date' => $request->event_date,
            'is_published' => $request->has('publish'),
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        // Gunakan findOrFail untuk memastikan data ada
        $event = Event::findOrFail($id);

        // 1. Hapus file fisik gambar dari storage agar tidak jadi sampah server
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }

        // 2. Gunakan forceDelete() untuk menghapus permanen dari tabel database
        $event->forceDelete();

        return redirect()->route('admin.events.index')->with('success', 'Event permanently deleted!');
    }

    public function togglePublish($id)
    {
        $event = Event::findOrFail($id);
        $event->is_published = !$event->is_published;
        $event->save();

        return back()->with('success', 'Status updated successfully!');
    }
}
