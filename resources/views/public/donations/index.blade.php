@extends('layouts.public')

@section('title', 'Donations')

@section('content')
<div class="bg-gradient-to-r from-red-600 to-red-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white mb-4">Support Our Causes</h1>
        <p class="text-red-100 text-lg">Help us make a difference through your generous donations</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @if($donations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($donations as $donation)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-red-500 to-red-700 p-6 text-white">
                        <h2 class="text-2xl font-bold mb-2">{{ $donation->title }}</h2>
                        <span class="inline-block bg-white/20 text-white text-sm px-3 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Active Campaign
                        </span>
                    </div>

                    <div class="p-6">
                        <!-- Description -->
                        <p class="text-gray-600 mb-6">{{ $donation->description }}</p>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span class="font-semibold">{{ $donation->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-500 to-red-700 h-full rounded-full transition-all duration-500" 
                                     style="width: {{ $donation->progress_percentage }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Amount Info -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1">Collected</p>
                                <p class="text-lg font-bold text-red-600">
                                    Rp {{ number_format($donation->collected_amount, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1">Target</p>
                                <p class="text-lg font-bold text-gray-800">
                                    Rp {{ number_format($donation->target_amount, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Bank Details -->
                        <div class="border-t pt-6">
                            <h3 class="font-semibold text-gray-800 mb-3">
                                <i class="fas fa-university mr-2 text-red-600"></i> Bank Transfer Details
                            </h3>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <pre class="text-sm text-gray-700 whitespace-pre-wrap font-mono">{{ $donation->bank_details }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-hand-holding-heart text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Active Campaigns</h3>
            <p class="text-gray-500">There are no donation campaigns at the moment.</p>
        </div>
    @endif
</div>
@endsection