@extends('layouts.alumni')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-32"></div>

        <div class="px-6 pb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-20">
                <!-- Profile Picture -->
                <div class="relative">
                    <img src="{{ $profile->profile_picture_url }}"
                        alt="{{ $profile->full_name }}"
                        class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white shadow-lg object-cover">

                    <form method="POST"
                        action="{{ route('alumni.profile.picture') }}"
                        enctype="multipart/form-data"
                        x-data="{ uploading: false }"
                        @submit="uploading = true">
                        @csrf
                        <label for="profile_picture"
                            class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer hover:bg-blue-700 shadow-lg">
                            <i class="fas fa-camera"></i>
                            <input type="file"
                                id="profile_picture"
                                name="profile_picture"
                                accept="image/*"
                                class="hidden"
                                @change="$el.form.submit()">
                        </label>
                    </form>
                </div>

                <!-- Profile Info -->
                <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-1">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $profile->full_name }}</h2>
                    <p class="text-gray-600">{{ $profile->current_job ?? 'Alumni' }}
                        @if($profile->company)
                        <span class="text-gray-400">at</span> {{ $profile->company }}
                        @endif
                    </p>
                    <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-2">
                        @if($profile->angkatan)
                        <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                            <i class="fas fa-graduation-cap mr-1"></i> {{ $profile->angkatan }}
                        </span>
                        @endif
                        @if($profile->graduation_year)
                        <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
                            <i class="fas fa-calendar mr-1"></i> {{ $profile->graduation_year }}
                        </span>
                        @endif
                        @if($profile->is_verified)
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Verified
                        </span>
                        @else
                        <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">
                            <i class="fas fa-clock mr-1"></i> Pending Verification
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 sm:mt-0 flex gap-2">
                    <a href="{{ route('alumni.profile.edit') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Toggle -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Profile Visibility</h3>
                <p class="text-sm text-gray-600 mt-1">
                    @if($profile->is_private)
                    Your profile is currently <span class="font-semibold text-red-600">hidden</span> from the alumni directory.
                    @else
                    Your profile is currently <span class="font-semibold text-green-600">visible</span> in the alumni directory.
                    @endif
                </p>
            </div>
            <form method="POST" action="{{ route('alumni.profile.privacy') }}">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="relative inline-flex h-8 w-14 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $profile->is_private ? 'bg-gray-300' : 'bg-blue-600' }}">
                    <span class="inline-block h-6 w-6 transform rounded-full bg-white transition-transform {{ $profile->is_private ? 'translate-x-1' : 'translate-x-7' }}"></span>
                </button>
            </form>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h3>
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
                    <p class="text-sm text-gray-800">{{ auth()->user()->email }}</p>
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

    @if($profile->has_business)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Bisnis / UMKM</h3>
        </div>
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">
                @if($profile->business_photo)
                <div class="w-full md:w-48">
                    <img src="{{ asset('storage/' . $profile->business_photo) }}"
                        alt="{{ $profile->business_name }}"
                        class="w-full h-48 md:h-32 object-cover rounded-lg shadow-sm">
                </div>
                @endif

                <div class="flex-1 space-y-3">
                    <div>
                        <h4 class="text-xl font-bold text-blue-600">{{ $profile->business_name }}</h4>
                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded mt-1">
                            {{ $profile->business_type }}
                        </span>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Deskripsi Usaha</p>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $profile->business_description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Social Media -->
    @if($profile->social_media_links)
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Social Media</h3>
        <div class="flex flex-wrap gap-3">
            @if(isset($profile->social_media_links['instagram']))
            <a href="{{ $profile->social_media_links['instagram'] }}"
                target="_blank"
                class="flex items-center px-4 py-2 bg-pink-50 text-pink-600 rounded-lg hover:bg-pink-100 transition">
                <i class="fab fa-instagram mr-2"></i> Instagram
            </a>
            @endif

            @if(isset($profile->social_media_links['linkedin']))
            <a href="{{ $profile->social_media_links['linkedin'] }}"
                target="_blank"
                class="flex items-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                <i class="fab fa-linkedin mr-2"></i> LinkedIn
            </a>
            @endif

            @if(isset($profile->social_media_links['facebook']))
            <a href="{{ $profile->social_media_links['facebook'] }}"
                target="_blank"
                class="flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                <i class="fab fa-facebook mr-2"></i> Facebook
            </a>
            @endif

            @if(isset($profile->social_media_links['twitter']))
            <a href="{{ $profile->social_media_links['twitter'] }}"
                target="_blank"
                class="flex items-center px-4 py-2 bg-sky-50 text-sky-600 rounded-lg hover:bg-sky-100 transition">
                <i class="fab fa-twitter mr-2"></i> Twitter
            </a>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection