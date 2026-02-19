@extends('layouts.admin') {{-- Menggunakan layout yang sama agar gaya konsisten --}}

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Overview')


@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-600">
        <h2 class="text-2xl font-bold text-gray-800">Hello, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-600">Welcome to the Admin Command Center. Here is what's happening with your alumni network.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Total Alumni</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_alumni'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-user-check fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Pending Verif</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['pending_verification'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-newspaper fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">News Posts</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_news'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-calendar-alt fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Total Events</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_events'] }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Newest Pending Verification</h3>
                <a href="{{ route('admin.alumni.index') }}" class="text-blue-600 text-sm hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Name</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Angkatan</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($latest_pending as $alumnus)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $alumnus->full_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $alumnus->angkatan }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.alumni.verify', $alumnus->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700 transition">
                                        Verify Now
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-check-circle text-green-500 mb-2 block text-2xl"></i>
                                All clear! No pending verifications.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4">Quick Shortcuts</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.news.create') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition group">
                    <i class="fas fa-plus text-blue-600 mr-3"></i>
                    <span class="text-gray-700 group-hover:text-blue-700">Create News Post</span>
                </a>
                <a href="{{ route('admin.events.create') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition group">
                    <i class="fas fa-calendar-plus text-blue-600 mr-3"></i>
                    <span class="text-gray-700 group-hover:text-blue-700">Add New Event</span>
                </a>
                <a href="{{ route('admin.alumni.export') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition group">
                    <i class="fas fa-file-export text-blue-600 mr-3"></i>
                    <span class="text-gray-700 group-hover:text-blue-700">Export Alumni Data (Excel)</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection