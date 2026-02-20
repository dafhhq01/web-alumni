@extends('layouts.admin')

@section('title', 'Manage Donations')
@section('page-title', 'Donation Management')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-lg shadow-md border-l-4 border-rose-500">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Program Donasi Alumni</h3>
            <p class="text-sm text-gray-600">Kelola penggalangan dana untuk baksos, renovasi, atau beasiswa.</p>
        </div>
        <a href="{{ route('admin.donations.create') }}" 
           class="inline-flex items-center justify-center px-6 py-2 bg-rose-500 text-white font-bold rounded-xl hover:bg-rose-600 transition shadow-sm">
            <i class="fas fa-plus-circle mr-2"></i> Buat Donasi Baru
        </a>
    </div>

    {{-- Stats Cards (Simple) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 bg-rose-100 rounded-lg text-rose-600 mr-4">
                <i class="fas fa-hand-holding-heart fa-lg"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Total Program</p>
                <p class="text-lg font-bold text-gray-800">{{ $donations->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 bg-green-100 rounded-lg text-green-600 mr-4">
                <i class="fas fa-check-circle fa-lg"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Status Aktif</p>
                <p class="text-lg font-bold text-gray-800">{{ $donations->where('status', 'active')->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg text-blue-600 mr-4">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold">Total Terkumpul</p>
                <p class="text-lg font-bold text-gray-800">Rp {{ number_format($donations->sum('collected_amount'), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Donation Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase">Campaign</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-center">Progress</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($donations as $donation)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-800">{{ $donation->title }}</div>
                            <div class="text-[11px] text-gray-500 line-clamp-1 max-w-xs">{{ Str::limit($donation->description, 50) }}</div>
                            <div class="mt-1 text-[10px] font-medium px-2 py-0.5 bg-gray-100 text-gray-600 rounded inline-block">
                                <i class="fas fa-university mr-1"></i> {{ Str::limit($donation->bank_details, 30) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col w-48 mx-auto">
                                <div class="flex justify-between mb-1">
                                    <span class="text-[10px] font-bold text-gray-600">{{ number_format($donation->collected_amount, 0, ',', '.') }}</span>
                                    <span class="text-[10px] font-bold text-rose-600">{{ $donation->progress_percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-rose-500 h-1.5 rounded-full" style="width: {{ $donation->progress_percentage }}%"></div>
                                </div>
                                <span class="text-[9px] text-gray-400 mt-1 text-right italic">Target: Rp {{ number_format($donation->target_amount, 0, ',', '.') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($donation->status === 'active')
                                <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-700 uppercase">Aktif</span>
                            @else
                                <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-gray-100 text-gray-700 uppercase">Ditutup</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <a href="{{ route('admin.donations.edit', $donation->id) }}" class="p-2 hover:bg-gray-50 text-blue-600 border-r border-gray-200" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                
                                <form action="{{ route('admin.donations.destroy', $donation->id) }}" 
                                      method="POST" 
                                      class="delete-donation-form" 
                                      data-title="{{ $donation->title }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="p-2 hover:bg-red-50 text-red-600 btn-delete-donation" title="Delete">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fas fa-donate text-4xl mb-3 block text-gray-200"></i>
                            Belum ada program donasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-donation');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-donation-form');
                const title = form.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Permanen?',
                    text: `Program donasi "${title}" akan dihapus selamanya dari database.`,
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus Total!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection