@extends('layouts.public')

@section('title', 'Alumni Directory')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-4">Alumni Directory</h1>
        <p class="text-blue-100 text-lg">Connect with our verified alumni community</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Search & Filter -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('alumni.directory') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="md:col-span-2">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by name..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Angkatan Filter -->
            <div>
                <select name="angkatan" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Angkatan</option>
                    @foreach($angkatanList as $angkatan)
                        <option value="{{ $angkatan }}" {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                            {{ $angkatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Graduation Year Filter -->
            <div>
                <select name="graduation_year" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Years</option>
                    @foreach($graduationYears as $year)
                        <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4 flex gap-2">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('alumni.directory') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Alumni Cards -->
    @if($alumni->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($alumni as $alumnus)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-700 h-24"></div>
                    <div class="px-6 pb-6 -mt-12">
                        <img src="{{ $alumnus->profile_picture_url }}" 
                             alt="{{ $alumnus->full_name }}" 
                             class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover mx-auto">
                        
                        <div class="text-center mt-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $alumnus->full_name }}</h3>
                            
                            @if($alumnus->current_job)
                                <p class="text-sm text-gray-600 mt-1">{{ $alumnus->current_job }}</p>
                            @endif
                            
                            @if($alumnus->company)
                                <p class="text-xs text-gray-500">{{ $alumnus->company }}</p>
                            @endif

                            <div class="mt-3 flex flex-wrap justify-center gap-2">
                                @if($alumnus->angkatan)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                        {{ $alumnus->angkatan }}
                                    </span>
                                @endif
                                @if($alumnus->graduation_year)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                        {{ $alumnus->graduation_year }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('alumni.show', $alumnus->id) }}" 
                               class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $alumni->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-users text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Alumni Found</h3>
            <p class="text-gray-500">Try adjusting your search or filter criteria.</p>
        </div>
    @endif
</div>
@endsection