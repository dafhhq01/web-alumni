@extends('layouts.admin')

@section('title', 'Buat Donasi')
@section('page-title', 'Tambah Program Donasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.donations.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 space-y-4">

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Nama Program Donasi</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('title') border-red-500 @enderror"
                        placeholder="Contoh: Donasi Peduli Bencana Alam atau Beasiswa Alumni" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Target Amount --}}
                    <div>
                        <label for="target_amount" class="block text-sm font-medium text-gray-700 mb-1">Target Dana (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm font-bold">Rp</span>
                            </div>
                            <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount') }}"
                                class="w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('target_amount') border-red-500 @enderror"
                                placeholder="0" required>
                        </div>
                        @error('target_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bank Details --}}
                    <div class="col-span-full">
                        <label for="bank_details" class="block text-sm font-medium text-gray-700 mb-1">Informasi Rekening / E-Wallet</label>
                        <textarea name="bank_details" id="bank_details" rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('bank_details') border-red-500 @enderror"
                            placeholder="Contoh:&#10;BCA - 123456789 a/n Yayasan&#10;Mandiri - 987654321 a/n Yayasan&#10;DANA - 08123456789" required>{{ old('bank_details') }}</textarea>
                        <p class="text-[10px] text-gray-500 mt-1 italic">* Gunakan baris baru (Enter) untuk memisahkan antar nomor rekening.</p>
                        @error('bank_details') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Penjelasan Donasi</label>
                    <textarea name="description" id="description" rows="8"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('description') border-red-500 @enderror"
                        placeholder="Jelaskan tujuan penggalangan dana ini secara lengkap...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Info Note --}}
                <div class="bg-rose-50 p-4 rounded-lg border border-rose-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-rose-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-rose-700 font-medium">
                                Secara default, status donasi baru akan langsung di-set ke <strong>Aktif</strong>. Anda bisa menutup program ini nanti melalui halaman Edit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.donations.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-bold rounded-lg text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                    <i class="fas fa-save mr-2"></i> Simpan Program Donasi
                </button>
            </div>
        </div>
    </form>
</div>
@endsection