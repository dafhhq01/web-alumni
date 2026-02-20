@extends('layouts.admin')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 space-y-4">
                
                {{-- Event Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" 
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                           placeholder="Enter event title..." required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Event Date --}}
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                        <input type="date" name="event_date" id="event_date" 
                               value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('event_date') border-red-500 @enderror" required>
                        @error('event_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Featured Image / Poster --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Banner / Poster (Optional)</label>
                        
                        {{-- Preview Gambar Lama --}}
                        @if($event->image_path)
                            <div class="mb-2">
                                <p class="text-[10px] text-gray-500 mb-1 italic">Current Image:</p>
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="Preview" class="h-20 w-32 object-cover rounded border border-gray-200 shadow-sm">
                            </div>
                        @endif

                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="text-xs text-gray-400 mt-1">Leave blank to keep current image. Format: JPG, PNG. Max: 2MB</p>
                    </div>
                </div>

                {{-- Content Description --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                    <textarea name="content" id="content" rows="10" 
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('content') border-red-500 @enderror"
                              placeholder="Describe the event details here...">{{ old('content', $event->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Publish Status --}}
                <div class="flex items-center space-x-3 pt-2">
                    <div class="flex items-center h-5">
                        <input id="publish" name="publish" type="checkbox" value="1" {{ old('publish', $event->is_published) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    </div>
                    <div class="text-sm">
                        <label for="publish" class="font-medium text-gray-700">Publish immediately</label>
                        <p class="text-gray-500">If checked, this event will be visible to the public.</p>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.events.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800 transition">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Event
                </button>
            </div>
        </div>
    </form>
</div>
@endsection