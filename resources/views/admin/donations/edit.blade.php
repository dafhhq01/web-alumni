@extends('layouts.admin')

@section('title', 'Edit Donasi')
@section('page-title', 'Edit Program Donasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <div class="p-6 space-y-4">

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Nama Program Donasi</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $donation->title) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('title') border-red-500 @enderror"
                        placeholder="Nama program..." required>
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
                            <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', (int)$donation->target_amount) }}"
                                class="w-full pl-10 rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 @error('target_amount') border-red-500 @enderror" required>
                        </div>
                    </div>

                    {{-- Collected Amount --}}
                    <div class="bg-rose-50 p-2 rounded-lg border border-rose-100">
                        <label for="collected_amount" class="block text-sm font-bold text-rose-700 mb-1">Dana Terkumpul (Rp)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-rose-600 sm:text-sm font-bold">Rp</span>
                            </div>
                            <input type="number" name="collected_amount" id="collected_amount" value="{{ old('collected_amount', (int)$donation->collected_amount) }}"
                                class="w-full pl-10 rounded-lg border-rose-200 bg-white shadow-sm focus:border-rose-500 focus:ring-rose-500" required>
                        </div>
                        <p class="text-[10px] text-rose-600 mt-1 italic">* Update jumlah ini jika ada donasi baru masuk.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Bank Details --}}
                    <div>
                        <label for="bank_details" class="block text-sm font-medium text-gray-700 mb-1">Informasi Rekening / E-Wallet</label>
                        <textarea name="bank_details" id="bank_details" rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500"
                            required>{{ old('bank_details', $donation->bank_details) }}</textarea>
                        <p class="text-[10px] text-gray-500 mt-1 italic">* Pisahkan tiap rekening dengan baris baru (Enter).</p>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Program</label>
                        <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500">
                            <option value="active" {{ old('status', $donation->status) == 'active' ? 'selected' : '' }}>Aktif (Menerima Donasi)</option>
                            <option value="closed" {{ old('status', $donation->status) == 'closed' ? 'selected' : '' }}>Ditutup (Target Tercapai/Selesai)</option>
                        </select>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <textarea name="description" id="description" rows="8"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500">{{ old('description', $donation->description) }}</textarea>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-100">
                <div class="text-xs text-gray-500 italic">
                    Dibuat oleh: {{ $donation->author->name ?? 'Admin' }}
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.donations.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800 self-center">Batal</a>
                    <button type="submit" class="inline-flex justify-center py-2.5 px-8 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-rose-500 hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all">
                        Update Data Donasi
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection