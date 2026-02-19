@extends('layouts.admin') {{-- Menggunakan layout yang sama agar gaya konsisten --}}

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Overview')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    {{-- Welcome Card --}}
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-600">
        <h2 class="text-2xl font-bold text-gray-800">Hello, {{ auth()->user()->name }}! 👑</h2>
        <p class="text-gray-600">Welcome to the Super Admin Control Center. You have full access to system management and administrator oversight.</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Admin Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-user-shield fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Total Admins</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_admins'] }}</h3>
            </div>
        </div>

        {{-- Total Alumni Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Total Alumni</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_alumni'] }}</h3>
            </div>
        </div>

        {{-- Pending Verification Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-user-check fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Pending Verif</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['pending_alumni'] }}</h3>
            </div>
        </div>

        {{-- News/System Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-newspaper fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500 font-medium">Total News</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_news'] }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Recent Admins Table --}}
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Newest Administrator Accounts</h3>
                <a href="{{ route('super-admin.manage-admins.index') }}" class="text-red-600 text-sm hover:underline">Manage All Admins</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Admin Name</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Email</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recent_admins as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $admin->created_at->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                No administrator accounts found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Shortcuts --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="font-bold text-gray-800 mb-4">Super Admin Shortcuts</h3>
            <div class="space-y-3">
                <a href="{{ route('super-admin.manage-admins.create') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition group">
                    <i class="fas fa-user-plus text-red-600 mr-3"></i>
                    <span class="text-gray-700 group-hover:text-red-700">Add New Admin</span>
                </a>
                <a href="{{ route('super-admin.manage-admins.index') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-red-50 hover:border-red-300 transition group">
                    <i class="fas fa-users-cog text-red-600 mr-3"></i>
                    <span class="text-gray-700 group-hover:text-red-700">Manage Permissions</span>
                </a>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">System Status</p>
                    <div class="flex items-center text-sm text-green-600 font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        All Systems Operational
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection