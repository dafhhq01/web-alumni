@extends('layouts.public')

@section('title', 'Gallery')

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-4">Photo Gallery</h1>
        <p class="text-green-100 text-lg">Explore our memorable moments and events</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @if($albums->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($albums as $album)
                <a href="{{ route('gallery.album', ['album_name' => $album->album_name]) }}"
                   class="group relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    
                    <!-- Cover Image -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $album->cover_image) }}" 
                             alt="{{ $album->album_name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        
                        <!-- Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">{{ $album->album_name }}</h3>
                            <div class="flex items-center justify-between text-sm">
                                @if($album->event_year)
                                    <span>
                                        <i class="fas fa-calendar mr-1"></i> {{ $album->event_year }}
                                    </span>
                                @endif
                                <span>
                                    <i class="fas fa-images mr-1"></i> {{ $album->photo_count }} {{ $album->photo_count > 1 ? 'photos' : 'photo' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Albums Yet</h3>
            <p class="text-gray-500">Check back later for photo galleries!</p>
        </div>
    @endif
</div>
@endsection