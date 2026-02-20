@extends('layouts.admin')

@section('title', 'Manage Events')
@section('page-title', 'Events Management')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-lg shadow-md border-l-4 border-indigo-600">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Upcoming & Past Events</h3>
            <p class="text-sm text-gray-600">Atur jadwal pertemuan, webinar, atau reuni alumni di sini.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" 
           class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-sm">
            <i class="fas fa-calendar-plus mr-2"></i> Add New Event
        </a>
    </div>

    {{-- Events Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase">Event Info</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-center">Execution Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($event->image_path)
                                    <img src="{{ asset('storage/' . $event->image_path) }}" class="h-12 w-12 object-cover rounded-lg mr-3 shadow-sm border">
                                @else
                                    <div class="h-12 w-12 bg-indigo-100 flex items-center justify-center rounded-lg mr-3 text-indigo-400">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-bold text-gray-800">{{ $event->title }}</div>
                                    <div class="text-xs text-gray-500">By: {{ $event->author->name ?? 'Admin' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-sm font-medium text-gray-700">
                                {{ $event->event_date->format('d M Y') }}
                            </div>
                            @if($event->event_date->isPast())
                                <span class="text-[10px] text-red-500 font-bold uppercase">Passed</span>
                            @else
                                <span class="text-[10px] text-green-500 font-bold uppercase">Upcoming</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.events.publish', $event->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="inline-block">
                                    @if($event->is_published)
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 transition">Published</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition">Draft</span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="p-2 hover:bg-gray-50 text-blue-600 border-r border-gray-200" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                
                                <form action="{{ route('admin.events.destroy', $event->id) }}" 
                                      method="POST" 
                                      class="delete-event-form" 
                                      data-title="{{ $event->title }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="p-2 hover:bg-red-50 text-red-600 btn-delete-event" title="Delete">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fas fa-calendar-times text-4xl mb-3 block text-gray-200"></i>
                            No events created yet.
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
        const deleteButtons = document.querySelectorAll('.btn-delete-event');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-event-form');
                const title = form.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Event?',
                    text: `Event "${title}" akan dihapus permanen.`,
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
@endsection