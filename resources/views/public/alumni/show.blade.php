@extends('layouts.public')

@section('title', $profile->full_name)

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('alumni.directory') }}" class="text-blue-100 hover:text-white mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Back to Directory
        </a>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-12">
    
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-32"></div>
        
        <div class="px-6 pb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-20">
                <!-- Profile Picture -->
                <img src="{{ $profile->profile_picture_url }}" 
                     alt="{{ $profile->full_name }}" 
                     class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-lg object-cover">

                <!-- Profile Info -->
                <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $profile->full_name }}</h1>
                    <p class="text-gray-600 text-lg">{{ $profile->current_job ?? 'Alumni' }} 
                        @if($profile->company)
                            <span class="text-gray-400">at</span> {{ $profile->company }}
                        @endif
                    </p>
                    <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-2">
                        @if($profile->angkatan)
                            <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                <i class="fas fa-graduation-cap mr-1"></i> {{ $profile->angkatan }}
                            </span>
                        @endif
                        @if($profile->graduation_year)
                            <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                                <i class="fas fa-calendar mr-1"></i> {{ $profile->graduation_year }}
                            </span>
                        @endif
                        <span class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Verified Alumni
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($profile->phone_number)
                <div class="flex items-center">
                    <i class="fas fa-phone text-blue-600 w-8"></i>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500">Phone</p>
                        <p class="text-sm text-gray-800">{{ $profile->phone_number }}</p>
                    </div>
                </div>
            @endif

            <div class="flex items-center">
                <i class="fas fa-envelope text-blue-600 w-8"></i>
                <div class="ml-3">
                    <p class="text-xs text-gray-500">Email</p>
                    <p class="text-sm text-gray-800">{{ $profile->user->email }}</p>
                </div>
            </div>

            @if($profile->address)
                <div class="flex items-start md:col-span-2">
                    <i class="fas fa-map-marker-alt text-blue-600 w-8 mt-1"></i>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500">Address</p>
                        <p class="text-sm text-gray-800">{{ $profile->address }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Social Media -->
    @if($profile->social_media_links)
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Connect on Social Media</h2>
            <div class="flex flex-wrap gap-3">
                @if(isset($profile->social_media_links['instagram']))
                    <a href="{{ $profile->social_media_links['instagram'] }}" 
                       target="_blank"
                       class="flex items-center px-4 py-2 bg-pink-50 text-pink-600 rounded-lg hover:bg-pink-100 transition">
                        <i class="fab fa-instagram text-xl mr-2"></i> Instagram
                    </a>
                @endif

                @if(isset($profile->social_media_links['linkedin']))
                    <a href="{{ $profile->social_media_links['linkedin'] }}" 
                       target="_blank"
                       class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                        <i class="fab fa-linkedin text-xl mr-2"></i> LinkedIn
                    </a>
                @endif

                @if(isset($profile->social_media_links['facebook']))
                    <a href="{{ $profile->social_media_links['facebook'] }}" 
                       target="_blank"
                       class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                        <i class="fab fa-facebook text-xl mr-2"></i> Facebook
                    </a>
                @endif

                @if(isset($profile->social_media_links['twitter']))
                    <a href="{{ $profile->social_media_links['twitter'] }}" 
                       target="_blank"
                       class="flex items-center px-4 py-2 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 transition">
                        <i class="fab fa-twitter text-xl mr-2"></i> Twitter
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection