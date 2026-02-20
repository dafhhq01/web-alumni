@extends('layouts.admin')

@section('title', 'Manage News')
@section('page-title', 'News Management')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-600">
        <div>
            <h3 class="text-xl font-bold text-gray-800">News Articles</h3>
            <p class="text-sm text-gray-600">Create, edit, and manage news for the alumni portal.</p>
        </div>
        <a href="{{ route('admin.news.create') }}"
            class="inline-flex items-center justify-center px-6 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-plus mr-2"></i> Add New News
        </a>
    </div>

    {{-- News Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase">Title</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($news as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="h-10 w-14 object-cover rounded mr-3 shadow-sm">
                                @else
                                <div class="h-10 w-14 bg-gray-200 flex items-center justify-center rounded mr-3 text-gray-400">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                                <div class="text-sm font-bold text-gray-800">{{ $item->title }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600 rounded">{{ $item->category ?? 'Uncategorized' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($item->is_published)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                            @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="p-2 hover:bg-gray-50 text-blue-600 border-r border-gray-200" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Modifikasi Form Delete --}}
                                <form action="{{ route('admin.news.destroy', $item->id) }}"
                                    method="POST"
                                    class="delete-news-form"
                                    data-title="{{ $item->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="p-2 hover:bg-red-50 text-red-600 btn-delete-news" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No news found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-news');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-news-form');
                const title = form.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Berita?',
                    text: `Artikel "${title}" akan dihapus permanen dari database.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus!',
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