@extends('layouts.public')

@section('title', $event->title)

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('events.index') }}" class="text-purple-600 hover:text-purple-700 mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Events
        </a>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <header class="mb-8">
        <!-- Event Date -->
        <div class="flex items-center mb-4">
            <div class="bg-purple-600 text-white rounded-lg p-4 text-center mr-6">
                <div class="text-3xl font-bold">{{ $event->event_date->format('d') }}</div>
                <div class="text-sm">{{ $event->event_date->format('M Y') }}</div>
            </div>
            <div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>
                <div class="flex items-center text-gray-600 text-sm">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>{{ $event->event_date->format('l, F d, Y') }}</span>
                    <span class="mx-3">•</span>
                    @if($event->event_date >= now()->toDateString())
                        <span class="text-green-600 font-semibold">
                            <i class="fas fa-clock mr-1"></i> Upcoming
                        </span>
                    @else
                        <span class="text-gray-500">
                            <i class="fas fa-check mr-1"></i> Past Event
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    @if($event->image_path)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $event->image_path) }}" 
                 alt="{{ $event->title }}" 
                 class="w-full rounded-lg shadow-lg">
        </div>
    @endif

    <!-- Content -->
    <div class="prose prose-lg max-w-none mb-12">
        {!! $event->content !!}
    </div>

    <!-- Related Events -->
    @if($relatedEvents->count() > 0)
        <div class="border-t pt-8 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedEvents as $related)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        @if($related->image_path)
                            <img src="{{ asset('storage/' . $related->image_path) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-calendar text-white text-3xl"></i>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="text-sm text-purple-600 font-semibold mb-2">
                                {{ $related->event_date->format('M d, Y') }}
                            </div>
                            <h3 class="font-semibold text-gray-800 line-clamp-2">
                                <a href="{{ route('events.show', $related->slug) }}" class="hover:text-purple-600">
                                    {{ $related->title }}
                                </a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection