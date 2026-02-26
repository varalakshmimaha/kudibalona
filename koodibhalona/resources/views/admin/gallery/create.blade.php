@extends('layouts.admin')

@section('title', 'Add New Gallery Item')
@section('header', 'Add Gallery Item')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            
            <!-- Image Upload -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">Gallery Image</label>
                <div class="relative group">
                    <input type="file" name="image" id="image-input" required
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-12 text-center group-hover:border-amber-400 transition-colors bg-gray-50">
                        <div id="preview-container" class="hidden mb-4">
                            <img id="image-preview" src="#" alt="Preview" class="max-h-48 mx-auto rounded-xl">
                        </div>
                        <div id="upload-placeholder">
                            <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-300 mb-4 group-hover:text-amber-500 transition-colors"></i>
                            <p class="text-sm text-gray-500 font-medium">Click to upload or drag and drop image</p>
                            <p class="text-xs text-gray-400 mt-1">Maximum 5MB (JPG, PNG, WebP)</p>
                        </div>
                    </div>
                </div>
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Title / Caption -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">Caption (Optional)</label>
                <input type="text" name="caption" value="{{ old('caption') }}"
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                    placeholder="Enter a short description of this image...">
                @error('caption') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Settings Grid -->
            <div class="grid grid-cols-2 gap-8 pt-4">
                <div class="space-y-4">
                    <label class="block text-sm font-bold text-gray-700">Display Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                </div>

                <div class="space-y-4">
                    <label class="block text-sm font-bold text-gray-700">Status</label>
                    <label class="flex items-center cursor-pointer pt-3">
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1" class="sr-only" checked>
                            <div class="block bg-gray-200 w-14 h-8 rounded-full transition-colors dot-bg"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform"></div>
                        </div>
                        <div class="ml-3 text-gray-700 font-medium text-sm">Active</div>
                    </label>
                </div>
            </div>

            <div class="space-y-4 pt-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_large" value="1" class="w-5 h-5 rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                    <span class="ml-3 text-sm font-bold text-gray-700">Display as Large Image</span>
                </label>
                <p class="text-xs text-gray-400 pl-8">Large images take up twice the space in the gallery grid for emphasis.</p>
            </div>

            <div class="pt-8 flex gap-4">
                <button type="submit" class="flex-grow py-4 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-lg shadow-amber-500/20 transform hover:-translate-y-0.5 transition-all">
                    Add to Gallery
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    input:checked ~ .dot-bg { background-color: #f59e0b; }
    input:checked ~ .dot { transform: translateX(100%); }
</style>

@section('scripts')
<script>
    document.getElementById('image-input').onchange = evt => {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('image-preview').src = URL.createObjectURL(file);
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        }
    }
</script>
@endsection
@endsection
