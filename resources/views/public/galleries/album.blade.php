@extends('layouts.public')

@section('title', $albumInfo->album_name)

@section('content')
<div class="bg-gradient-to-r from-green-600 to-green-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('gallery.index') }}" class="text-green-100 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Gallery
        </a>
        <h1 class="text-4xl font-bold text-white mb-2">{{ $albumInfo->album_name }}</h1>
        @if($albumInfo->event_year)
            <p class="text-green-100 text-lg">
                <i class="fas fa-calendar mr-2"></i> {{ $albumInfo->event_year }}
            </p>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{ 
        lightbox: false, 
        currentImage: '',
        images: {{ $photos->pluck('image_path')->map(fn($path) => asset('storage/' . $path))->toJson() }},
        currentIndex: 0,
        showImage(index) {
            this.currentIndex = index;
            this.currentImage = this.images[index];
            this.lightbox = true;
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
            this.currentImage = this.images[this.currentIndex];
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            this.currentImage = this.images[this.currentIndex];
        }
    }">
        @foreach($photos as $index => $photo)
            <div class="aspect-square overflow-hidden rounded-lg cursor-pointer group" 
                 @click="showImage({{ $index }})">
                <img src="{{ asset('storage/' . $photo->image_path) }}" 
                     alt="Photo {{ $index + 1 }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            </div>
        @endforeach

        <!-- Lightbox Modal -->
        <div x-show="lightbox" 
             x-cloak
             @click.self="lightbox = false"
             @keydown.escape.window="lightbox = false"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4">
            
            <!-- Close Button -->
            <button @click="lightbox = false" 
                    class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>

            <!-- Previous Button -->
            <button @click="prev" 
                    class="absolute left-4 text-white text-4xl hover:text-gray-300 z-10">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Image -->
            <img :src="currentImage" 
                 class="max-w-full max-h-full object-contain">

            <!-- Next Button -->
            <button @click="next" 
                    class="absolute right-4 text-white text-4xl hover:text-gray-300 z-10">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Counter -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm">
                <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
            </div>
        </div>
    </div>
</div>
@endsection