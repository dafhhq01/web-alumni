@extends('layouts.admin')

@section('title', 'Manage Admins')
@section('page-title', 'Administrator Management')

{{-- Import SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header & Action Button --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-lg shadow-md border-l-4 border-red-600">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Admin Accounts</h3>
            <p class="text-sm text-gray-600">Total registered administrators: <strong>{{ $admins->count() }}</strong></p>
        </div>
        <a href="{{ route('super-admin.manage-admins.create') }}" 
           class="inline-flex items-center justify-center px-6 py-2 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-sm">
            <i class="fas fa-user-plus mr-2"></i> Add New Admin
        </a>
    </div>

    {{-- Admin Table Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Admin Info</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Role</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold mr-3">
                                    {{ substr($admin->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-800">{{ $admin->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $admin->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700">{{ $admin->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $admin->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Administrator
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-stretch border border-gray-200 rounded-lg shadow-sm overflow-hidden bg-white" style="height: 38px;">
                                {{-- Edit Button --}}
                                <a href="{{ route('super-admin.manage-admins.edit', $admin->id) }}"
                                    class="flex items-center justify-center w-10 hover:bg-gray-50 text-gray-600 transition-colors border-r border-gray-200"
                                    title="Edit Admin">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>

                                {{-- Delete Button with SweetAlert --}}
                                <form action="{{ route('super-admin.manage-admins.destroy', $admin->id) }}"
                                    method="POST"
                                    class="m-0 p-0 flex delete-admin-form"
                                    data-name="{{ $admin->name }}">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="flex items-center justify-center w-10 h-full hover:bg-red-50 text-red-600 transition-colors btn-delete-admin border-none bg-transparent"
                                        style="outline: none;"
                                        title="Hapus Admin">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fas fa-user-shield text-4xl mb-3 block text-gray-200"></i>
                            No administrator accounts found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- SweetAlert Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-admin');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-admin-form');
                const adminName = form.getAttribute('data-name');

                Swal.fire({
                    title: 'Delete Administrator?',
                    text: `Account "${adminName}" will be permanently removed from the system.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Yes, Delete Permanently!',
                    cancelButtonText: 'Cancel',
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
@endsection