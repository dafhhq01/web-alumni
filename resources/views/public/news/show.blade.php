@extends('layouts.public')

@section('title', $news->title)

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-700 mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to News
        </a>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <header class="mb-8">
        @if($news->category)
            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-1 rounded-full mb-4">
                {{ $news->category }}
            </span>
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>

        <div class="flex items-center text-gray-600 text-sm">
            <i class="fas fa-calendar mr-2"></i>
            <span>{{ $news->created_at->format('F d, Y') }}</span>
            <span class="mx-3">•</span>
            <i class="fas fa-user mr-2"></i>
            <span>{{ $news->author->name }}</span>
        </div>
    </header>

    <!-- Featured Image -->
    @if($news->image_path)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $news->image_path) }}" 
                 alt="{{ $news->title }}" 
                 class="w-full rounded-lg shadow-lg">
        </div>
    @endif

    <!-- Content -->
    <div class="prose prose-lg max-w-none mb-12">
        {!! $news->content !!}
    </div>

    <!-- Related News -->
    @if($relatedNews->count() > 0)
        <div class="border-t pt-8 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related News</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedNews as $related)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        @if($related->image_path)
                            <img src="{{ asset('storage/' . $related->image_path) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-3xl"></i>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                                <a href="{{ route('news.show', $related->slug) }}" class="hover:text-blue-600">
                                    {{ $related->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $related->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection