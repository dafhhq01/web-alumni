@extends('layouts.admin')

@section('title', 'Unggah Galeri')
@section('page-title', 'Tambah Foto ke Galeri')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Album --}}
                    <div>
                        <label for="album_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Album / Kegiatan</label>
                        <input type="text" name="album_name" id="album_name" value="{{ old('album_name') }}" 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('album_name') border-red-500 @enderror" 
                               placeholder="Contoh: Reuni Akbar 2024" required>
                        @error('album_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Tahun Kegiatan --}}
                    <div>
                        <label for="event_year" class="block text-sm font-semibold text-gray-700 mb-2">Tahun (Opsional)</label>
                        <input type="number" name="event_year" id="event_year" value="{{ old('event_year', date('Y')) }}" 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                               placeholder="YYYY">
                    </div>
                </div>

                {{-- Upload Area --}}
                <div x-data="imageViewer()">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Foto</label>
                    
                    <div class="relative group">
                        <div class="w-full min-h-[200px] border-2 border-dashed border-gray-300 group-hover:border-blue-400 rounded-2xl flex flex-col items-center justify-center p-6 transition-colors bg-gray-50">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-blue-500 mb-3"></i>
                            <p class="text-sm text-gray-600">Klik atau tarik foto ke sini</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG atau JPEG (Max. 2MB per file)</p>
                            
                            <input type="file" name="images[]" id="images" multiple accept="image/*" 
                                   @change="previewImages"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </div>

                    {{-- Image Preview Grid --}}
                    <template x-if="images.length > 0">
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-4 mt-6">
                            <template x-for="(image, index) in images" :key="index">
                                <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                                    <img :src="image" class="w-full h-full object-cover">
                                    <button type="button" @click="removeImage(index)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center hover:bg-red-700 transition">
                                        <i class="fas fa-times text-[10px]"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Footer --}}
            <div class="bg-gray-50 px-8 py-4 flex items-center justify-end space-x-3 border-t border-gray-100">
                <a href="{{ route('admin.gallery.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                <button type="submit" class="inline-flex justify-center py-2.5 px-8 border border-transparent shadow-sm text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md">
                    <i class="fas fa-save mr-2"></i> Mulai Unggah
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function imageViewer() {
        return {
            images: [],
            previewImages(event) {
                const files = event.target.files;
                this.images = []; // Reset preview
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.images.push(e.target.result);
                    };
                    reader.readAsDataURL(files[i]);
                }
            },
            removeImage(index) {
                // Catatan: Ini hanya menghapus preview, 
                // Untuk menghapus dari input file asli membutuhkan logika tambahan FileList.
                // Namun untuk preview sederhana ini sudah sangat membantu user.
                this.images.splice(index, 1);
            }
        }
    }
</script>
@endpush
@endsection