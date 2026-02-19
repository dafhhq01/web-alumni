@extends('layouts.admin')

@section('title', 'Manage Alumni')
@section('page-title', 'Alumni Management')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
<div class="max-w-7xl mx-auto">

    @if(session('info'))
    <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative shadow-sm" role="alert">
        <span class="block sm:inline">{{ session('info') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('admin.alumni.index') }}" method="GET"
            class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">

            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Search Name
                </label>
                <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Enter alumni name..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status
                </label>
                <select name="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                </select>
            </div>

            {{-- UMKM Filter --}}
            <div class="flex items-center bg-gray-50 px-4 py-3 rounded-xl border border-gray-200 shadow-sm">
                <input type="checkbox"
                    name="business_only"
                    value="1"
                    {{ request('business_only') ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">

                <label class="ml-3 text-sm font-medium text-gray-700">
                    Hanya Alumni UMKM
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>

                <a href="{{ route('admin.alumni.index') }}"
                    class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-200 transition text-center shadow-sm">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Alumni List</h3>
            <div class="flex items-center space-x-3">
                <form action="{{ route('admin.alumni.export') }}" method="GET" id="export-selected-form" class="hidden m-0 flex">
                    <input type="hidden" name="ids" id="selected-ids">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center text-sm shadow-sm whitespace-nowrap">
                        <i class="fas fa-check-square mr-2"></i> Export Terpilih (<span id="count-selected">0</span>)
                    </button>
                </form>

                <a href="{{ route('admin.alumni.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center text-sm shadow-sm whitespace-nowrap">
                    <i class="fas fa-file-excel mr-2"></i> Export Semua
                </a>

                <span class="text-sm text-gray-500 ml-4 hidden md:block">Showing {{ $alumni->firstItem() }}...</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 w-10">
                            <input type="checkbox" id="select-all" class="rounded text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Alumni Info</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Education</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($alumni as $person)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <input type="checkbox" class="alumni-checkbox rounded text-blue-600 focus:ring-blue-500" value="{{ $person->id }}">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <!-- <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3">
                                    {{ substr($person->full_name, 0, 1) }}
                                </div> -->
                                <img
                                    src="{{ $person->profile_picture_url }}"
                                    class="h-10 w-10 rounded-full object-cover mr-3"
                                    alt="Profile">
                                <div>
                                    <a href="{{ route('admin.alumni.show', $person->id) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline transition">
                                        {{ $person->full_name }}
                                    </a>
                                    <div class="text-xs text-gray-500">{{ $person->user->email ?? 'No Email' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700">Angkatan: <strong>{{ $person->angkatan ?? '-' }}</strong></div>
                            <div class="text-xs text-gray-500">Lulus: {{ $person->graduation_year ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($person->is_verified)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Verified
                            </span>
                            @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-stretch border border-gray-200 rounded-lg shadow-sm overflow-hidden bg-white" style="height: 38px;">
                                <a href="{{ route('admin.alumni.show', $person->id) }}"
                                    class="group flex items-center justify-center w-10 hover:bg-indigo-50 text-indigo-600 transition-colors border-r border-gray-200"
                                    title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>

                                @if(!$person->is_verified)
                                <form action="{{ route('admin.alumni.verify', $person->id) }}" method="POST" class="m-0 p-0 flex">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="flex items-center justify-center w-10 h-full hover:bg-blue-50 text-blue-600 transition-colors border-r border-gray-200 border-none bg-transparent"
                                        style="margin: 0; padding: 0; outline: none; border-right: 1px solid #e5e7eb;"
                                        title="Verify Alumni">
                                        <i class="fas fa-check-circle text-xs"></i>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.alumni.unverify', $person->id) }}" method="POST" class="m-0 p-0 flex">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="flex items-center justify-center w-10 h-full hover:bg-yellow-50 text-yellow-600 transition-colors border-r border-gray-200 border-none bg-transparent"
                                        style="margin: 0; padding: 0; outline: none; border-right: 1px solid #e5e7eb;"
                                        title="Revoke Verification">
                                        <i class="fas fa-times-circle text-xs"></i>
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('admin.alumni.edit', $person->id) }}"
                                    class="flex items-center justify-center w-10 hover:bg-gray-50 text-gray-600 transition-colors border-r border-gray-200"
                                    title="Edit Data">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>

                                <form action="{{ route('admin.alumni.destroy', $person->id) }}"
                                    method="POST"
                                    class="m-0 p-0 flex delete-form"
                                    data-name="{{ $person->full_name }}">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="flex items-center justify-center w-10 h-full hover:bg-red-50 text-red-600 transition-colors btn-delete-trigger border-none bg-transparent"
                                        style="margin: 0; padding: 0; outline: none;"
                                        title="Hapus Alumni">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fas fa-user-slash text-4xl mb-3 block text-gray-300"></i>
                            No alumni found matching your criteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $alumni->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const deleteButtons = document.querySelectorAll('.btn-delete-trigger');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah aksi default

                const form = this.closest('.delete-form');
                const alumniName = form.getAttribute('data-name');

                Swal.fire({
                    title: 'Hapus Data Alumni?',
                    text: `Akun "${alumniName}" akan dihapus permanen. Email ini akan bisa digunakan mendaftar ulang kembali.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus Akun!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // --- Logic Export Checkbox (TAMBAHKAN INI) ---
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.alumni-checkbox');
        const exportForm = document.getElementById('export-selected-form');
        const selectedIdsInput = document.getElementById('selected-ids');
        const countSpan = document.getElementById('count-selected');

        function updateExportButton() {
            const checkedBoxes = Array.from(document.querySelectorAll('.alumni-checkbox:checked'));
            const checkedIds = checkedBoxes.map(cb => cb.value);

            if (checkedIds.length > 0) {
                exportForm.classList.remove('hidden');
                selectedIdsInput.value = checkedIds.join(',');
                countSpan.innerText = checkedIds.length;
            } else {
                exportForm.classList.add('hidden');
            }
        }

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
                updateExportButton();
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateExportButton);
        });

    });
</script>

@endsection