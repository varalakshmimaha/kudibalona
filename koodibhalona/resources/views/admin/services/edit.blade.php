@extends('layouts.admin')

@section('title', 'Edit Service')
@section('header', 'Edit Service: ' . $service->title)

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Service Title</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-500 transition-all">
                </div>
                
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tag/Subtitle (e.g. Health & Hygiene)</label>
                    <input type="text" name="tag" value="{{ old('tag', $service->tag) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-500 transition-all">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-500 transition-all">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Featured Image</label>
                    @if($service->image)
                        <div class="mb-4">
                            <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-32 h-20 object-cover rounded-lg border border-gray-200" alt="">
                        </div>
                    @endif
                    <input type="file" name="image_file" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition-all">
                    <p class="text-xs text-gray-500 mt-2 italic">Leave empty to keep current image</p>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-amber-500 transition-all">
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <label class="block text-sm font-bold text-gray-700">Sub-Services / Links</label>
                    <button type="button" onclick="addItem()" class="text-xs font-bold text-amber-600 hover:text-amber-700 flex items-center">
                        <i data-lucide="plus" class="w-3 h-3 mr-1"></i> Add Item
                    </button>
                </div>
                <div id="sub-links-container" class="space-y-3">
                    @php 
                        $subLinks = old('sub_links', $service->sub_links ?? []); 
                        if(is_null($subLinks)) $subLinks = [];
                    @endphp
                    @forelse($subLinks as $link)
                    <div class="flex items-center space-x-2">
                        <input type="text" name="sub_links[]" value="{{ $link }}" class="flex-grow bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition-all">
                        <button type="button" onclick="this.parentElement.remove()" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @empty
                    <div class="flex items-center space-x-2">
                        <input type="text" name="sub_links[]" class="flex-grow bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition-all">
                        <button type="button" onclick="this.parentElement.remove()" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mb-8">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" class="sr-only peer" {{ $service->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 dark:peer-focus:ring-amber-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-amber-600"></div>
                    <span class="ml-3 text-sm font-bold text-gray-700">Active Status</span>
                </label>
            </div>

            <div class="flex items-center space-x-4 border-t border-gray-100 pt-8">
                <button type="submit" class="px-8 py-3 bg-amber-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-amber-500/20 hover:scale-[1.02] transition-all">
                    Update Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addItem() {
        const container = document.getElementById('sub-links-container');
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2';
        div.innerHTML = `
            <input type="text" name="sub_links[]" class="flex-grow bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-amber-500 transition-all">
            <button type="button" onclick="this.parentElement.remove()" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        `;
        container.appendChild(div);
        lucide.createIcons();
    }
</script>
@endsection
