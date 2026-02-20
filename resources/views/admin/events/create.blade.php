@extends('layouts.admin')

@section('title', 'Create Event')
@section('page-title', 'Create New Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 space-y-4">
                
                {{-- Event Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                           placeholder="Contoh: Reuni Akbar Angkatan 2020" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Execution Date --}}
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                        <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('event_date') border-red-500 @enderror" required>
                        @error('event_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Featured Image / Poster --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Banner / Poster</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Max: 2MB</p>
                    </div>
                </div>

                {{-- Content Description --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                    <textarea name="content" id="content" rows="10" 
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('content') border-red-500 @enderror"
                              placeholder="Tulis detail acara, lokasi, dan agenda di sini...">{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Publish Status --}}
                <div class="flex items-center space-x-3 pt-2">
                    <div class="flex items-center h-5">
                        <input id="publish" name="publish" type="checkbox" value="1" {{ old('publish') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    </div>
                    <div class="text-sm">
                        <label for="publish" class="font-medium text-gray-700">Publish immediately</label>
                        <p class="text-gray-500">Jika dicentang, event akan langsung tampil di halaman depan.</p>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-y-0 space-x-3">
                <a href="{{ route('admin.events.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save Event
                </button>
            </div>
        </div>
    </form>
</div>
@endsection