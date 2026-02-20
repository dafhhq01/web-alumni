@extends('layouts.admin')

@section('title', 'Gallery Management')
@section('page-title', 'Manajemen Galeri Foto')

@section('content')
<div class="space-y-6">
    {{-- Header Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <p class="text-gray-600">Total koleksi: <span class="font-bold text-blue-600">{{ $galleries->total() }} Foto</span></p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm">
            <i class="fas fa-plus-circle mr-2"></i> Unggah Foto Baru
        </a>
    </div>

    @if($galleries->count() > 0)
    {{-- Gallery Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($galleries as $item)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-md transition-all duration-300">
            {{-- Image Preview --}}
            <div class="relative aspect-video overflow-hidden bg-gray-100">
                <img src="{{ $item->image_url }}" alt="{{ $item->album_name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-duration-500">

                {{-- Year Badge --}}
                @if($item->event_year)
                <div class="absolute top-3 left-3">
                    <span class="bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ $item->event_year }}
                    </span>
                </div>
                @endif

                {{-- Hover Overlay for Actions --}}
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    {{-- Button Edit --}}
                    <a href="{{ route('admin.gallery.edit', $item->id) }}" class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-600 hover:text-white transition-colors shadow-lg">
                        <i class="fas fa-edit"></i>
                    </a>

                    {{-- Button Delete --}}
                    <form action="{{ route('admin.gallery.destroy', $item->id) }}"
                        method="POST"
                        class="delete-gallery-form"
                        data-album="{{ $item->album_name }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="bg-white text-red-600 p-3 rounded-full hover:bg-red-600 hover:text-white transition-colors shadow-lg btn-delete-gallery">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info --}}
            <div class="p-4">
                <h3 class="font-bold text-gray-800 truncate mb-1" title="{{ $item->album_name }}">
                    {{ $item->album_name }}
                </h3>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-[11px] text-gray-500 flex items-center">
                        <i class="fas fa-user-edit mr-1"></i> {{ $item->uploader->name ?? 'System' }}
                    </span>
                    <span class="text-[10px] text-gray-400 italic">
                        {{ $item->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $galleries->links() }}
    </div>
    @else
    {{-- Empty State --}}
    <div class="bg-white rounded-3xl border-2 border-dashed border-gray-200 p-12 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-50 rounded-full mb-4">
            <i class="fas fa-images text-3xl text-gray-300"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-800">Belum ada koleksi foto</h3>
        <p class="text-gray-500 max-w-xs mx-auto mt-2">Mulai bangun galeri kenangan alumni dengan mengunggah foto kegiatan pertama Anda.</p>
        <a href="{{ route('admin.gallery.create') }}" class="mt-6 inline-block text-blue-600 font-bold hover:underline">
            Klik di sini untuk upload
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-gallery');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-gallery-form');
                const albumName = form.getAttribute('data-album');

                Swal.fire({
                    title: 'Hapus Foto?',
                    text: `Foto dari album "${albumName}" akan dihapus permanen dari server.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', // Tailwind red-500
                    cancelButtonColor: '#6b7280', // Tailwind gray-500
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    borderRadius: '1rem'
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