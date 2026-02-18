@extends('layouts.public')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-600 to-blue-800 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Welcome to Alumni System
            </h1>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Connect with fellow alumni, stay updated with latest news and events, and be part of our growing community
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                        Join Now
                    </a>
                    <a href="{{ route('alumni.directory') }}" 
                       class="bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition">
                        Browse Alumni
                    </a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('alumni.profile') }}" 
                           class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                            My Profile
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white py-12 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['total_alumni'] }}</div>
                <div class="text-gray-600">Total Alumni</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-green-600 mb-2">{{ $stats['verified_alumni'] }}</div>
                <div class="text-gray-600">Verified Alumni</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-purple-600 mb-2">{{ $stats['total_news'] }}</div>
                <div class="text-gray-600">News Published</div>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-orange-600 mb-2">{{ $stats['upcoming_events'] }}</div>
                <div class="text-gray-600">Upcoming Events</div>
            </div>
        </div>
    </div>
</div>

<!-- Latest News Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Latest News</h2>
        <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            View All <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    @if($latestNews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $news)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($news->image_path)
                        <img src="{{ asset('storage/' . $news->image_path) }}" 
                             alt="{{ $news->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-5xl"></i>
                        </div>
                    @endif

                    <div class="p-6">
                        @if($news->category)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full mb-3">
                                {{ $news->category }}
                            </span>
                        @endif

                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            <a href="{{ route('news.show', $news->slug) }}" class="hover:text-blue-600">
                                {{ $news->title }}
                            </a>
                        </h3>

                        <p class="text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar mr-2"></i>{{ $news->created_at->format('M d, Y') }}
                        </p>

                        <a href="{{ route('news.show', $news->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 py-8">No news available at the moment.</p>
    @endif
</div>

<!-- Upcoming Events Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Upcoming Events</h2>
            <a href="{{ route('events.index') }}" class="text-purple-600 hover:text-purple-700 font-medium">
                View All <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($upcomingEvents as $event)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        @if($event->image_path)
                            <img src="{{ asset('storage/' . $event->image_path) }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-calendar text-white text-5xl"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-600 text-white rounded-lg p-3 text-center mr-4">
                                    <div class="text-2xl font-bold">{{ $event->event_date->format('d') }}</div>
                                    <div class="text-xs">{{ $event->event_date->format('M') }}</div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-2">
                                        <a href="{{ route('events.show', $event->slug) }}" class="hover:text-purple-600">
                                            {{ $event->title }}
                                        </a>
                                    </h3>
                                </div>
                            </div>

                            <a href="{{ route('events.show', $event->slug) }}" 
                               class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
                                View Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 py-8">No upcoming events at the moment.</p>
        @endif
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Join Our Alumni Community</h2>
        <p class="text-xl text-blue-100 mb-8">
            Connect with fellow alumni, share your success stories, and stay updated with the latest news
        </p>
        @guest
            <a href="{{ route('register') }}" 
               class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                Register Now
            </a>
        @endguest
    </div>
</div>

@endsection