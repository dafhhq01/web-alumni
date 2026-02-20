@extends('layouts.admin')

@section('title', 'Create News')
@section('page-title', 'Create New Article')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 space-y-4">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Article Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror" 
                           placeholder="Enter news title..." required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Category --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category" id="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Category</option>
                            <option value="Announcement">Announcement</option>
                            <option value="Achievement">Achievement</option>
                            <option value="Career">Career</option>
                            <option value="Campus Life">Campus Life</option>
                        </select>
                    </div>

                    {{-- Featured Image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Max: 2MB</p>
                    </div>
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="10" 
                              class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Publish Status --}}
                <div class="flex items-center space-x-3 pt-2">
                    <div class="flex items-center h-5">
                        <input id="publish" name="publish" type="checkbox" value="1" 
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </div>
                    <div class="text-sm">
                        <label for="publish" class="font-medium text-gray-700">Publish immediately</label>
                        <p class="text-gray-500">If unchecked, this will be saved as a draft.</p>
                    </div>
                </div>
            </div>

            {{-- Form Footer --}}
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.news.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Article
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi TinyMCE sesuai CDN yang ada di layout admin kamu
    tinymce.init({
        selector: '#content',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | removeformat',
        menubar: false,
        height: 400,
    });
</script>
@endpush