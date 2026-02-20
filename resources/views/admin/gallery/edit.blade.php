@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Preview Gambar Saat Ini --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Foto Saat Ini</label>
                        <div class="relative aspect-video rounded-2xl overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        <p class="mt-4 text-xs text-gray-500 italic">* Biarkan kosong jika tidak ingin mengganti foto.</p>
                        
                        <div class="mt-4">
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    {{-- Form Input --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Album / Judul Foto</label>
                            <input type="text" name="album_name" value="{{ old('album_name', $gallery->album_name) }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Acara</label>
                            <input type="number" name="event_year" value="{{ old('event_year', $gallery->event_year) }}" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="pt-4 flex items-center gap-3">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.gallery.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl transition-all">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection