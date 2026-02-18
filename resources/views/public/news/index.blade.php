@extends('layouts.public')

@section('title', 'News')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-4">Latest News</h1>
        <p class="text-blue-100 text-lg">Stay updated with our latest news and announcements</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('news.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search news..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Category Filter -->
            <div>
                <select name="category" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-3 flex gap-2">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('news.index') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- News Grid -->
    @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $item)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-5xl"></i>
                        </div>
                    @endif

                    <div class="p-6">
                        @if($item->category)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full mb-3">
                                {{ $item->category }}
                            </span>
                        @endif

                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            <a href="{{ route('news.show', $item->slug) }}" class="hover:text-blue-600">
                                {{ $item->title }}
                            </a>
                        </h3>

                        <div class="text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar mr-2"></i>{{ $item->created_at->format('M d, Y') }}
                        </div>

                        <div class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {!! strip_tags($item->content) !!}
                        </div>

                        <a href="{{ route('news.show', $item->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No News Found</h3>
            <p class="text-gray-500">Check back later for updates!</p>
        </div>
    @endif
</div>
@endsection