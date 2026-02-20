@extends('layouts.admin')

@section('title', 'Edit News')
@section('page-title', 'Edit Article')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 space-y-4">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Article Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Category --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category" id="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            {{-- Tambahkan opsi Uncategorized sebagai default jika null --}}
                            <option value="" {{ is_null($news->category) ? 'selected' : '' }}>Uncategorized</option>

                            @foreach(['Announcement', 'Achievement', 'Career', 'Campus Life'] as $cat)
                            <option value="{{ $cat }}" {{ (old('category', $news->category) == $cat) ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Featured Image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Featured Image (Leave blank to keep current)</label>
                        @if($news->image_path)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $news->image_path) }}" class="h-20 w-32 object-cover rounded shadow-sm border">
                        </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="10"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content', $news->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Publish Status --}}
                <div class="flex items-center space-x-3 pt-2">
                    <input id="publish" name="publish" type="checkbox" value="1"
                        {{ old('publish', $news->is_published) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="publish" class="font-medium text-gray-700">Publish Article</label>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.news.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">
                    Update Article
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    tinymce.init({
        selector: '#content',
        width: '100%',
        promotion: false,
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | removeformat',
        menubar: false,
        height: 400,
        branding: false,
    });
</script>
@endpush