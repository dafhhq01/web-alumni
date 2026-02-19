@extends('layouts.admin')

@section('title', 'Detail Alumni - ' . $alumnus->full_name)

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.alumni.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
        <div class="flex space-x-2">
            @if(!$alumnus->is_verified)
            <form action="{{ route('admin.alumni.verify', $alumnus->id) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition shadow-sm">
                    <i class="fas fa-check mr-2"></i> Verifikasi Sekarang
                </button>
            </form>
            @endif
            <a href="{{ route('admin.alumni.edit', $alumnus->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-10 text-white relative">
            <div class="flex flex-col md:flex-row items-center">
                <div class="h-24 w-24 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white mb-4 md:mb-0">
                    <img src="{{ $alumnus->profile_picture_url }}" alt="Photo" class="w-full h-full object-cover">
                </div>
                <div class="md:ml-6 text-center md:text-left">
                    <h1 class="text-3xl font-bold">{{ $alumnus->full_name }}</h1>
                    <p class="opacity-90">{{ $alumnus->user->email ?? 'No Email' }}</p>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $alumnus->is_verified ? 'bg-green-400 text-green-900' : 'bg-yellow-400 text-yellow-900' }}">
                        {{ $alumnus->is_verified ? 'Akun Terverifikasi' : 'Menunggu Verifikasi' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Akademik</h3>
                <div class="space-y-3">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Angkatan</p>
                    <p class="text-gray-800 font-medium">{{ $alumnus->angkatan ?? 'Tidak diisi' }}</p>

                    <p class="text-sm text-gray-500 uppercase tracking-wider mt-4">Tahun Lulus</p>
                    <p class="text-gray-800 font-medium">{{ $alumnus->graduation_year ?? 'Tidak diisi' }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Karir</h3>
                <div class="space-y-3">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Pekerjaan Saat Ini</p>
                    <p class="text-gray-800 font-medium">{{ $alumnus->current_job ?? 'Tidak diisi' }}</p>

                    <p class="text-sm text-gray-500 uppercase tracking-wider mt-4">Perusahaan</p>
                    <p class="text-gray-800 font-medium">{{ $alumnus->company ?? 'Tidak diisi' }}</p>
                </div>
            </div>

            <div class="md:col-span-2">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Kontak & Alamat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nomor Telepon</p>
                        <p class="text-gray-800">{{ $alumnus->phone_number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="text-gray-800">{{ $alumnus->address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Container Informasi Usaha --}}
    @if($alumnus->has_business)
    <div class="mt-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 text-white">
                <h3 class="text-lg font-bold flex items-center">
                    <i class="fas fa-store mr-2"></i> Informasi Usaha
                </h3>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                    <div class="md:col-span-1">
                        @if($alumnus->business_photo)
                        <img src="{{ asset('storage/' . $alumnus->business_photo) }}"
                            class="w-full h-56 object-cover rounded-xl shadow-md border border-gray-100">
                        @else
                        <div class="w-full h-56 flex flex-col items-center justify-center bg-gray-50 rounded-xl text-gray-400 border border-dashed border-gray-300">
                            <i class="fas fa-image text-4xl mb-2"></i>
                            <span class="text-xs uppercase tracking-widest">No Photo</span>
                        </div>
                        @endif
                    </div>

                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-semibold">Nama Usaha</p>
                            <p class="text-gray-800 font-bold text-xl mt-1">{{ $alumnus->business_name ?? 'Tidak diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-semibold">Jenis Usaha</p>
                            <div class="mt-1">
                                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium border border-blue-100">
                                    {{ $alumnus->business_type ?? 'Tidak diisi' }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400 uppercase tracking-widest font-semibold">Deskripsi</p>
                            <p class="text-gray-600 leading-relaxed mt-1 italic">
                                "{{ $alumnus->business_description ?? 'Tidak ada deskripsi usaha.' }}"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="mt-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            {{-- Header Biru tetap ada agar serasi --}}
            <div class="bg-gradient-to-r from-gray-400 to-gray-500 px-6 py-4 text-white">
                <h3 class="text-lg font-bold flex items-center">
                    <i class="fas fa-store mr-2"></i> Informasi Usaha
                </h3>
            </div>

            {{-- Body Putih dengan pesan kosong --}}
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
                    <i class="fas fa-store-slash text-gray-300 text-3xl"></i>
                </div>
                <p class="text-gray-500 font-medium text-lg">Alumni ini belum mendaftarkan usaha.</p>
                <p class="text-gray-400 text-sm mt-1">Data UMKM atau bisnis tidak tersedia saat ini.</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Container Media Sosial (SELALU MUNCUL) --}}
    <div class="mt-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            @if($alumnus->social_media_links && count(array_filter($alumnus->social_media_links)) > 0)
            {{-- Header Biru jika ada data --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4 text-white">
                <h3 class="text-lg font-bold flex items-center">
                    <i class="fas fa-share-alt mr-2"></i> Media Sosial Alumni
                </h3>
            </div>

            {{-- Konten List Sosmed --}}
            <div class="p-8">
                <div class="flex flex-wrap gap-4">
                    @if(isset($alumnus->social_media_links['instagram']))
                    <a href="{{ $alumnus->social_media_links['instagram'] }}" target="_blank" class="flex items-center px-4 py-3 bg-pink-50 text-pink-600 rounded-xl hover:bg-pink-100 transition shadow-sm border border-pink-100">
                        <i class="fab fa-instagram text-xl mr-3"></i>
                        <span class="font-medium">Instagram</span>
                    </a>
                    @endif

                    @if(isset($alumnus->social_media_links['linkedin']))
                    <a href="{{ $alumnus->social_media_links['linkedin'] }}" target="_blank" class="flex items-center px-4 py-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition shadow-sm border border-blue-100">
                        <i class="fab fa-linkedin text-xl mr-3"></i>
                        <span class="font-medium">LinkedIn</span>
                    </a>
                    @endif

                    @if(isset($alumnus->social_media_links['facebook']))
                    <a href="{{ $alumnus->social_media_links['facebook'] }}" target="_blank" class="flex items-center px-4 py-3 bg-indigo-50 text-indigo-700 rounded-xl hover:bg-indigo-100 transition shadow-sm border border-indigo-100">
                        <i class="fab fa-facebook text-xl mr-3"></i>
                        <span class="font-medium">Facebook</span>
                    </a>
                    @endif

                    @if(isset($alumnus->social_media_links['twitter']))
                    <a href="{{ $alumnus->social_media_links['twitter'] }}" target="_blank" class="flex items-center px-4 py-3 bg-sky-50 text-sky-600 rounded-xl hover:bg-sky-100 transition shadow-sm border border-sky-100">
                        <i class="fab fa-twitter text-xl mr-3"></i>
                        <span class="font-medium">Twitter</span>
                    </a>
                    @endif
                </div>
            </div>
            @else
            {{-- Header Abu-abu jika tidak ada data --}}
            <div class="bg-gradient-to-r from-gray-400 to-gray-500 px-6 py-4 text-white">
                <h3 class="text-lg font-bold flex items-center">
                    <i class="fas fa-share-alt mr-2"></i> Media Sosial Alumni
                </h3>
            </div>

            {{-- Tampilan Kosong (Senada dengan else usaha) --}}
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
                    <i class="fas fa-unlink text-gray-300 text-3xl"></i>
                </div>
                <p class="text-gray-500 font-medium text-lg">Alumni belum mencantumkan media sosial.</p>
                <p class="text-gray-400 text-sm mt-1">Tautan Instagram, LinkedIn, atau lainnya tidak tersedia.</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection