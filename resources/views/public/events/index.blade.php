@extends('layouts.public')

@section('title', 'Events')

@section('content')
<div class="bg-gradient-to-r from-purple-600 to-purple-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-4">Events</h1>
        <p class="text-purple-100 text-lg">Join our upcoming events and activities</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('events.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search events..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Filter -->
            <div>
                <select name="filter" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Events</option>
                    <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>Past</option>
                </select>
            </div>

            <div>
                <button type="submit" 
                        class="w-full bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </div>
        </form>
    </div>

    <!-- Events Grid -->
    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
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
                        <!-- Event Date Badge -->
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-600 text-white rounded-lg p-3 text-center mr-4">
                                <div class="text-2xl font-bold">{{ $event->event_date->format('d') }}</div>
                                <div class="text-xs">{{ $event->event_date->format('M Y') }}</div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 line-clamp-2">
                                    <a href="{{ route('events.show', $event->slug) }}" class="hover:text-purple-600">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <div class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {!! strip_tags($event->content) !!}
                        </div>

                        <!-- Status Badge -->
                        @if($event->event_date >= now()->toDateString())
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full mb-4">
                                <i class="fas fa-clock mr-1"></i> Upcoming
                            </span>
                        @else
                            <span class="inline-block bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full mb-4">
                                <i class="fas fa-check mr-1"></i> Past Event
                            </span>
                        @endif

                        <a href="{{ route('events.show', $event->slug) }}" 
                           class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
                            View Details <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-calendar text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Events Found</h3>
            <p class="text-gray-500">Check back later for upcoming events!</p>
        </div>
    @endif
</div>
@endsection