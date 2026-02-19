@extends('layouts.admin')

@section('title', 'Tambah Admin Baru')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('super-admin.manage-admins.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center transition group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        {{-- Header Section --}}
        <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-white to-gray-50">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600 mr-4 shadow-sm">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Admin Baru</h2>
                    <p class="text-gray-500">Daftarkan akun administrator baru untuk mengelola sistem.</p>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <form action="{{ route('super-admin.manage-admins.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full pl-10 px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="Masukkan nama lengkap admin">
                    </div>
                    @error('name') 
                        <div class="mt-2 p-2 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-600 text-xs font-medium"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="admin@sekolah.com">
                    </div>
                    @error('email') 
                        <div class="mt-2 p-2 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-600 text-xs font-medium"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-10 px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="Buat password minimal 8 karakter">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 italic">
                        <i class="fas fa-shield-alt mr-1 text-gray-400"></i> Gunakan kombinasi huruf dan angka untuk keamanan.
                    </p>
                    @error('password') 
                        <div class="mt-2 p-2 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-600 text-xs font-medium"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <a href="{{ route('super-admin.manage-admins.index') }}" 
                   class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">
                    Batal
                </a>
                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Daftarkan Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection