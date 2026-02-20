@extends('layouts.public')

@section('title', $donation->title)

@section('content')
<div class=" min-h-screen pb-12">
    <div class="bg-gradient-to-r from-red-600 to-red-800 py-16 text-white text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">{{ $donation->title }}</h1>
            <p class="text-red-100 italic">"Giving is not just about making a donation. It is about making a difference."</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 -mt-10">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-3 underline decoration-red-500">About This Campaign</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $donation->description }}</p>
                </div>

                <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-university mr-3 text-red-600"></i> Payment Methods / Bank Transfer
                </h2>

                <div class="grid gap-4">
                    @php
                        // Memecah baris bank_details menjadi array
                        $accounts = explode("\n", str_replace("\r", "", $donation->bank_details));
                    @endphp

                    @foreach($accounts as $account)
                        @if(trim($account) != "")
                            <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-100 rounded-xl group hover:bg-blue-100 transition">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow-sm mr-4">
                                        <i class="fas fa-wallet text-blue-500"></i>
                                    </div>
                                    <span class="font-mono text-gray-700 font-bold tracking-tight account-number">{{ $account }}</span>
                                </div>
                                <button onclick="copyToClipboard('{{ trim($account) }}', this)" 
                                        class="bg-white border border-blue-300 text-blue-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-600 hover:text-white transition flex items-center">
                                    <i class="fas fa-copy mr-2"></i> <span>Copy</span>
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-10 p-4 bg-yellow-50 rounded-lg border border-yellow-200 flex">
                    <i class="fas fa-info-circle text-yellow-600 mt-1 mr-3"></i>
                    <p class="text-sm text-yellow-700">
                        Mohon sertakan kode unik atau berita acara jika diperlukan. Konfirmasi donasi Anda kepada pengurus alumni setelah melakukan transfer.
                    </p>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('donations.index') }}" class="text-gray-500 hover:text-red-600 font-medium transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Campaigns
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text, btn) {
        // Logika untuk hanya mengambil angka/nomor rekening jika ada teks lain
        // Jika ingin copy mentah-mentah satu baris, gunakan 'text' langsung.
        
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.innerHTML;
            btn.classList.replace('bg-white', 'bg-green-500');
            btn.classList.replace('text-blue-600', 'text-white');
            btn.innerHTML = '<i class="fas fa-check mr-2"></i> Copied!';

            // Toast notifikasi
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Copied to clipboard!'
            });

            setTimeout(() => {
                btn.classList.replace('bg-green-500', 'bg-white');
                btn.classList.replace('text-white', 'text-blue-600');
                btn.innerHTML = originalText;
            }, 2000);
        });
    }
</script>
@endpush
@endsection