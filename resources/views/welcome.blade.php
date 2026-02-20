@extends('layouts.public')

@section('title', 'Home')

@section('content')

<!-- Background Utama -->
<div class="min-h-screen">

    <!-- Gradient Blob Placeholder - Atas -->
    <!-- <div class="absolute top-0 left-0 w-full h-96 pointer-events-none overflow-hidden">
        <img src="{{ asset('images/gradient-blob-top.png') }}" alt="" class="w-full h-full object-cover opacity-60">
    </div> -->

    <!-- Hero Section -->
    <section class="relative pt-20 pb-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center">
                <!-- Heading dengan Gradient Text -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-2">
                    <span class="text-gray-900">Kenangan Itu</span><br>
                    <span style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Tidak Pernah Hilang</span>
                </h1>

                <!-- Button CTA -->
                <div class="mt-8 mb-12">
                    @guest
                    <a href="{{ route('register') }}"
                        class="inline-block px-10 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        Masih Ingat?
                    </a>
                    @else
                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                    <a href="{{ auth()->user()->hasRole('super-admin') ? route('super-admin.dashboard') : route('admin.dashboard') }}"
                        class="inline-block px-10 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('alumni.profile') }}"
                        class="inline-block px-10 py-3 rounded-full text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        Profil Saya
                    </a>
                    @endif
                    @endguest
                </div>

                <!-- Hero Illustration -->
                <div class="relative max-w-4xl mx-auto">
                    <img src="{{ asset('images/hero-illustration.png') }}" alt="Ilustrasi Alumni" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Gradient Blob Placeholder - Tengah -->
    <!-- <div class="absolute top-1/2 left-0 w-full h-96 pointer-events-none overflow-hidden -translate-y-1/2">
        <img src="{{ asset('images/gradient-blob-middle.png') }}" alt="" class="w-full h-full object-cover opacity-40">
    </div> -->

    <!-- Alumni SMPN 215 Angkatan 96 Section -->
    <section class="relative py-16">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Section Title -->
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16" style="color: #3851A5;">
                Alumni SMPN 215 Angkatan 96
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Tentang Kami -->
                <div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #3851A5;">Tentang Kami</h3>
                    <p class="text-lg font-semibold mb-4" style="color: #7391E7;">
                        Menghubungkan Kembali Para Alumni SMP
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Mengabadikan kenangan dan menjalin silaturahmi antar alumni sekolah kita. Bersama, kita merajut kembali cerita lama menjadi ikatan baru.
                    </p>
                </div>

                <!-- Right: Informasi Alumni Card -->
                <div class="rounded-2xl p-6 shadow-lg" style="background: linear-gradient(90deg, #D6DBE8 0%, #BACBFA 100%);">
                    <div class="rounded-xl px-6 py-3 mb-6" style="background: linear-gradient(90deg, #3851A5 0%, #7391E7 100%);">
                        <h4 class="text-white font-bold text-lg">Informasi Alumni</h4>
                        <p class="text-blue-100 text-sm">SMPN 215 angkatan 96</p>
                    </div>

                    <div class="space-y-4">
                        <!-- <div class="flex justify-between items-center py-3 px-4 rounded-lg bg-white/60">
                            <span class="font-medium text-gray-700">Total Alumni</span>
                            <span class="font-bold text-xl" style="color: #3851A5;">{{ $stats['total_alumni'] ?? '20' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 px-4 rounded-lg bg-white/60">
                            <span class="font-medium text-gray-700">Total Siswi</span>
                            <span class="font-bold text-xl" style="color: #3851A5;">{{ $stats['verified_alumni'] ?? '20' }}</span>
                        </div> -->
                        <div class="flex justify-between items-center py-3 px-4 rounded-lg bg-white/60">
                            <span class="font-medium text-gray-700">Total Anggota</span>
                            <span class="font-bold text-xl" style="color: #3851A5;">{{ $stats['total_alumni'] ?? '40' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Album Kenangan Section -->
    <section class="relative py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl md:text-3xl font-bold mb-10" style="color: #3851A5;">
                Album Kenangan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if(isset($albums) && $albums->count() > 0)
                @foreach($albums as $album)
                <a href="{{ route('gallery.album', urlencode($album->album_name)) }}" class="group">
                    <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300" style="background: linear-gradient(180deg, #7391E7 0%, #EFE6F7 100%); padding: 4px;">
                        <div class="bg-white rounded-lg overflow-hidden">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $album->cover_image) }}"
                                    alt="{{ $album->album_name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                {{-- Badge Jumlah Foto --}}
                                <div class="absolute bottom-2 right-2 bg-black/50 text-white text-[10px] px-2 py-1 rounded-md backdrop-blur-sm">
                                    <i class="fas fa-images mr-1"></i> {{ $album->photo_count }} Foto
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 truncate">{{ $album->album_name }}</h3>
                                <p class="text-xs text-blue-600 font-medium">{{ $album->event_year ?? 'Tahun tidak diset' }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                {{-- Placeholder jika kosong --}}
                @for($i = 0; $i < 3; $i++)
                    <div class="rounded-xl overflow-hidden bg-gray-100 p-8 text-center border-2 border-dashed border-gray-200">
                    <i class="fas fa-image text-gray-300 text-4xl mb-2"></i>
                    <p class="text-gray-400 text-sm">Belum ada album</p>
            </div>
            @endfor
            @endif
        </div>
</div>
</section>

<!-- Kegiatan & Informasi Section -->
<section class="relative py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: #3851A5;">
            Kegiatan & Informasi
        </h2>

        <!-- Badge -->
        <div class="inline-block px-4 py-2 rounded-full text-white text-sm font-medium mb-8" style="background: linear-gradient(90deg, #3851A5 0%, #7391E7 100%);">
            Acara & Berita Terkini
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @if($latestNews->count() > 0)
            @foreach($latestNews->take(2) as $news)
            <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" style="background: linear-gradient(180deg, #7391E7 0%, #EFE6F7 100%); padding: 4px;">
                <div class="bg-white rounded-lg overflow-hidden">
                    @if($news->image_path)
                    <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}" class="w-full h-56 object-cover">
                    @else
                    <div class="w-full h-56 flex items-center justify-center" style="background: linear-gradient(135deg, #1a3a52 0%, #2d5a7b 50%, #4a90a4 100%);">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-800 text-lg">{{ $news->title }}</h3>
                        <p class="text-gray-500 text-sm mt-2">{{ $news->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <!-- Placeholder News Cards -->
            @for($i = 0; $i < 2; $i++)
                <div class="rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" style="background: linear-gradient(180deg, #7391E7 0%, #EFE6F7 100%); padding: 4px;">
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="w-full h-56 flex items-center justify-center" style="background: linear-gradient(135deg, #1a3a52 0%, #2d5a7b 50%, #4a90a4 100%);">
                        <div class="text-center">
                            <div class="w-20 h-20 mx-auto mb-2 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-users text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-800 text-lg">Reuni Akbar</h3>
                    </div>
                </div>
        </div>
        @endfor
        @endif
    </div>
    </div>
</section>

<!-- Pengurus Section -->
<section class="relative py-16">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold mb-10" style="color: #3851A5;">
            Pengurus
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            {{-- Data Manual Pengurus --}}
            @php
            $manualPengurus = [
            ['name' => 'Nama Ketua', 'jabatan' => 'Ketua Alumni', 'foto' => 'default-avatar.png'],
            ['name' => 'Nama Wakil', 'jabatan' => 'Wakil Ketua', 'foto' => 'default-avatar.png'],
            ['name' => 'Nama Sekretaris', 'jabatan' => 'Sekretaris', 'foto' => 'default-avatar.png'],
            ['name' => 'Nama Bendahara', 'jabatan' => 'Bendahara', 'foto' => 'default-avatar.png'],
            ];
            @endphp

            @foreach($manualPengurus as $p)
            <div class="text-center group">
                <div class="w-24 h-24 md:w-32 md:h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg transition-transform duration-300 group-hover:scale-105"
                    style="background: linear-gradient(135deg, #7391E7 0%, #EFE6F7 100%); padding: 3px;">
                    <div class="w-full h-full rounded-full overflow-hidden bg-white">
                        {{-- Mengambil foto dari public/images/ --}}
                        <img src="{{ asset('images/' . $p['foto']) }}"
                            alt="{{ $p['name'] }}"
                            class="w-full h-full object-cover shadow-inner"
                            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p['name']) }}&color=7F9CF5&background=EBF4FF'">
                    </div>
                </div>
                <h3 class="font-bold text-gray-800">{{ $p['name'] }}</h3>
                <p class="text-sm text-blue-500 font-medium">{{ $p['jabatan'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Gradient Blob Placeholder - Bawah -->
<!-- <div class="absolute bottom-0 left-0 w-full h-64 pointer-events-none overflow-hidden">
        <img src="{{ asset('images/gradient-blob-bottom.png') }}" alt="" class="w-full h-full object-cover opacity-50">
    </div> -->

<!-- Footer Section -->
<footer class="relative py-20 overflow-hidden">
    <!-- Footer Gradient Background Placeholder -->
    <!-- <div class="absolute inset-0 pointer-events-none">
            <img src="{{ asset('images/footer-gradient.png') }}" alt="" class="w-full h-full object-cover">
        </div> -->

    <div class="max-w-7xl mx-auto px-6 relative z-10 overflow-hidden">
        <div class="text-center">
            <h2 class="text-[15vw] md:text-[200px] font-black opacity-20 select-none whitespace-nowrap"
                style="color: rgba(123, 145, 231, 0.3); letter-spacing: 0.1em; line-height: 0.8;">
                alumni
            </h2>
        </div>
    </div>

</footer>

</div>

@endsection