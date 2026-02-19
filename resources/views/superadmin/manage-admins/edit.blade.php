@extends('layouts.admin')

@section('title', 'Edit Admin - ' . $admin->name)

@section('content')
<div class="max-w-4xl mx-auto py-8">
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('super-admin.manage-admins.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center transition group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Batal dan Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        {{-- Header Section --}}
        <div class="p-8 border-b border-gray-100 bg-gradient-to-r from-white to-gray-50">
            <h2 class="text-2xl font-bold text-gray-800">Edit Akun Administrator</h2>
            <p class="text-gray-500">Perbarui informasi kredensial untuk <strong>{{ $admin->name }}</strong>.</p>
        </div>

        {{-- Form Section --}}
        <form action="{{ route('super-admin.manage-admins.update', $admin->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            {{-- Avatar Placeholder (Aesthetic) --}}
            <div class="mb-8 p-6 bg-red-50 rounded-2xl border border-red-100 flex flex-col items-center shadow-sm">
                <div class="h-24 w-24 rounded-full bg-red-600 flex items-center justify-center text-white text-3xl font-bold shadow-lg mb-2">
                    {{ substr($admin->name, 0, 1) }}
                </div>
                <span class="text-xs font-bold uppercase tracking-wider text-red-600">Administrator Role</span>
            </div>

            <div class="grid grid-cols-1 gap-6">
                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                            class="w-full pl-10 px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name') 
                        <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> 
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                            class="w-full pl-10 px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="nama@email.com">
                    </div>
                    @error('email') 
                        <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> 
                    @enderror
                </div>

                {{-- Password --}}
                <div class="pt-4 border-t border-gray-100">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Opsional)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-lock text-sm"></i>
                        </span>
                        <input type="password" name="password"
                            class="w-full pl-10 px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-red-500 outline-none transition shadow-sm"
                            placeholder="Masukkan password baru jika ingin mengganti">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 italic">
                        <i class="fas fa-info-circle mr-1 text-gray-400"></i> Biarkan kosong jika tidak ingin mengubah password.
                    </p>
                    @error('password') 
                        <p class="text-red-500 text-xs mt-1 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> 
                    @enderror
                </div>
            </div>

            {{-- Action Button --}}
            <div class="mt-10 flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-red-700 transition shadow-lg flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection