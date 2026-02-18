@extends('layouts.alumni')

@section('title', 'Edit Alumni - ' . $alumnus->full_name)

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-6">
        <a href="{{ route('admin.alumni.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Batal dan Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800">Edit Profil Alumni</h2>
            <p class="text-gray-500">Perbarui data informasi alumni secara manual.</p>
        </div>

        <form action="{{ route('admin.alumni.update', $alumnus->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <div class="mb-8 p-6 bg-blue-50 rounded-2xl border border-blue-100 flex flex-col items-center shadow-sm">
                <div class="relative group mb-4">
                    <img src="{{ $alumnus->profile_picture_url }}"
                        alt="Profile"
                        class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-default">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                </div>

                <div class="w-full flex flex-col items-center justify-center">
                    <label class="block text-sm font-semibold text-blue-800 mb-2 text-center">Ganti Foto Profil Alumni</label>

                    <div class="flex flex-col items-center w-full">
                        <input type="file" name="profile_picture"
                            class="block w-full max-w-xs text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-xs file:font-semibold
                          file:bg-blue-600 file:text-white
                          hover:file:bg-blue-700
                          focus:outline-none
                          cursor-pointer">

                        {{-- Hint Text --}}
                        <p class="text-xs text-gray-500 mt-2 text-center italic">
                            Format: JPG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.
                        </p>
                    </div>

                    {{-- Error Message UI - Sama dengan UI Bisnis --}}
                    @error('profile_picture')
                    <div class="mt-3 w-full max-w-md p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium text-center">
                            {{ $message }}
                        </p>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $alumnus->full_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Angkatan</label>
                    <input type="text" name="angkatan" value="{{ old('angkatan', $alumnus->angkatan) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus</label>
                    <input type="number" name="graduation_year" value="{{ old('graduation_year', $alumnus->graduation_year) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $alumnus->phone_number) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label>
                    <input type="text" name="current_job" value="{{ old('current_job', $alumnus->current_job) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Perusahaan</label>
                    <input type="text" name="company" value="{{ old('company', $alumnus->company) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                        placeholder="Masukkan alamat lengkap domisili saat ini...">{{ old('address', $alumnus->address) }}</textarea>
                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2 border-t pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi UMKM</h3>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Punya Usaha?</label>
                    <select name="has_business"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="0" {{ !$alumnus->has_business ? 'selected' : '' }}>Tidak</option>
                        <option value="1" {{ $alumnus->has_business ? 'selected' : '' }}>Ya</option>
                    </select>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Usaha</label>
                        <input type="text" name="business_name"
                            value="{{ old('business_name', $alumnus->business_name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Usaha</label>
                        <input type="text" name="business_type"
                            value="{{ old('business_type', $alumnus->business_type) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Usaha</label>
                        <textarea name="business_description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">{{ old('business_description', $alumnus->business_description) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Usaha
                        </label>

                        <input
                            type="file"
                            name="business_photo"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none
                            @error('business_photo') border-red-500 @else border-gray-300 @enderror">

                        {{-- Hint Text --}}
                        <p class="text-xs text-gray-500 mt-1">
                            Format: JPG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.
                        </p>

                        {{-- Error Message UI --}}
                        @error('business_photo')
                        <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-600 font-medium">
                                {{ $message }}
                            </p>
                        </div>
                        @enderror

                        @if($alumnus->business_photo)
                        <img src="{{ asset('storage/' . $alumnus->business_photo) }}"
                            class="w-32 h-32 object-cover mt-4 rounded-lg shadow">
                        @endif
                    </div>

                </div>

                <div class="md:col-span-2 border-t pt-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tautan Media Sosial</h3>
                </div>

                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center mr-3 border border-pink-100">
                            <i class="fab fa-instagram text-pink-500"></i>
                        </div>
                        <input type="url" name="social_instagram"
                            value="{{ old('social_instagram', $alumnus->social_media_links['instagram'] ?? '') }}"
                            placeholder="https://instagram.com/username"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3 border border-blue-100">
                            <i class="fab fa-linkedin text-blue-600"></i>
                        </div>
                        <input type="url" name="social_linkedin"
                            value="{{ old('social_linkedin', $alumnus->social_media_links['linkedin'] ?? '') }}"
                            placeholder="https://linkedin.com/in/username"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center mr-3 border border-indigo-100">
                            <i class="fab fa-facebook text-indigo-600"></i>
                        </div>
                        <input type="url" name="social_facebook"
                            value="{{ old('social_facebook', $alumnus->social_media_links['facebook'] ?? '') }}"
                            placeholder="https://facebook.com/username"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-sky-50 rounded-lg flex items-center justify-center mr-3 border border-sky-100">
                            <i class="fab fa-twitter text-sky-500"></i>
                        </div>
                        <input type="url" name="social_twitter"
                            value="{{ old('social_twitter', $alumnus->social_media_links['twitter'] ?? '') }}"
                            placeholder="https://twitter.com/username"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection