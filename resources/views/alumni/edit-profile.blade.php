@extends('layouts.alumni')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Your Profile</h2>
            <p class="text-gray-600 mt-2">Update your information below.</p>
        </div>

        <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="full_name"
                    id="full_name"
                    value="{{ old('full_name', $profile->full_name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
                @error('full_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Angkatan & Graduation Year -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Angkatan
                    </label>
                    <input type="text"
                        name="angkatan"
                        id="angkatan"
                        value="{{ old('angkatan', $profile->angkatan) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('angkatan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="graduation_year" class="block text-sm font-medium text-gray-700 mb-2">
                        Graduation Year
                    </label>
                    <input type="number"
                        name="graduation_year"
                        id="graduation_year"
                        value="{{ old('graduation_year', $profile->graduation_year) }}"
                        min="1950"
                        max="{{ date('Y') + 10 }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('graduation_year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                    Phone Number
                </label>
                <input type="text"
                    name="phone_number"
                    id="phone_number"
                    value="{{ old('phone_number', $profile->phone_number) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('phone_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Job & Company -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="current_job" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Job
                    </label>
                    <input type="text"
                        name="current_job"
                        id="current_job"
                        value="{{ old('current_job', $profile->current_job) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('current_job')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                        Company
                    </label>
                    <input type="text"
                        name="company"
                        id="company"
                        value="{{ old('company', $profile->company) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('company')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                    Address
                </label>
                <textarea name="address"
                    id="address"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address', $profile->address) }}</textarea>
                @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-md font-bold text-gray-800 mb-4">Informasi Bisnis/UMKM</h3>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Punya Usaha?</label>
                        <select name="has_business" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="0" {{ old('has_business', $profile->has_business) == '0' ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('has_business', $profile->has_business) == '1' ? 'selected' : '' }}>Ya</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Usaha</label>
                            <input type="text" name="business_name" value="{{ old('business_name', $profile->business_name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Usaha</label>
                            <input type="text" name="business_type" value="{{ old('business_type', $profile->business_type) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Usaha</label>
                        <textarea name="business_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ old('business_description', $profile->business_description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Usaha</label>
                        @if($profile->business_photo)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $profile->business_photo) }}" alt="Business Photo" class="w-32 h-32 object-cover rounded-lg shadow-sm border">
                            <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="business_photo" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <p class="text-xs text-gray-500 mt-1 italic">Format: JPG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                        @error('business_photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Social Media Links</label>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fab fa-instagram text-pink-500 text-xl w-8"></i>
                        <input type="url"
                            name="social_instagram"
                            value="{{ old('social_instagram', $profile->social_media_links['instagram'] ?? '') }}"
                            placeholder="https://instagram.com/username"
                            class="flex-1 ml-3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="flex items-center">
                        <i class="fab fa-linkedin text-blue-600 text-xl w-8"></i>
                        <input type="url"
                            name="social_linkedin"
                            value="{{ old('social_linkedin', $profile->social_media_links['linkedin'] ?? '') }}"
                            placeholder="https://linkedin.com/in/username"
                            class="flex-1 ml-3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="flex items-center">
                        <i class="fab fa-facebook text-blue-500 text-xl w-8"></i>
                        <input type="url"
                            name="social_facebook"
                            value="{{ old('social_facebook', $profile->social_media_links['facebook'] ?? '') }}"
                            placeholder="https://facebook.com/username"
                            class="flex-1 ml-3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="flex items-center">
                        <i class="fab fa-twitter text-sky-500 text-xl w-8"></i>
                        <input type="url"
                            name="social_twitter"
                            value="{{ old('social_twitter', $profile->social_media_links['twitter'] ?? '') }}"
                            placeholder="https://twitter.com/username"
                            class="flex-1 ml-3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('alumni.profile') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection