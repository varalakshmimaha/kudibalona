@extends('layouts.admin')

@section('title', 'Manage Banners')
@section('header', 'Page Banners')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-xl p-4 text-sm">
        Upload and manage each page banner/image from one dropdown.
        Recommended image size: 1920x600 for banners, 1200x800 for content images.
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-amber-50/60">
            <h3 class="text-lg font-bold text-gray-800">Banner/Image CRUD</h3>
            <p class="text-gray-500 text-xs mt-1">Choose slot from dropdown, then upload or remove.</p>
        </div>
        <form action="{{ route('admin.banners.update') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Page Slot</label>
                    <select name="banner_slot" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Select page slot</option>
                        @foreach($bannerSlots as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Image</label>
                    <input type="file" name="banner_image" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                </div>
            </div>
            <label class="inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="delete_banner" value="1" class="rounded border-gray-300">
                Remove selected slot image
            </label>
            <div>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all text-sm uppercase tracking-wider">
                    Save Selected Slot
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Current Slot Images</h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($bannerSlots as $key => $label)
                @php $img = $banners[$key] ?? null; @endphp
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-gray-50">
                    <div class="px-4 py-3 border-b border-gray-200 bg-white">
                        <p class="text-sm font-bold text-gray-800">{{ $label }}</p>
                    </div>
                    <div class="h-36 bg-gray-100">
                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $label }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">No image uploaded</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-slate-50">
            <h3 class="text-lg font-bold text-gray-800">Home Hero Text Settings</h3>
            <p class="text-gray-500 text-xs mt-1">Used when hero slides are empty.</p>
        </div>
        <form action="{{ route('admin.banners.update') }}" method="POST" class="p-6 md:p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Banner Title</label>
                    <input type="text" name="banner_1_title" value="{{ $banners['banner_1_title'] ?? '' }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Banner Subtitle</label>
                    <input type="text" name="banner_1_subtitle" value="{{ $banners['banner_1_subtitle'] ?? '' }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Button Text</label>
                    <input type="text" name="banner_1_btn_text" value="{{ $banners['banner_1_btn_text'] ?? '' }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Button Link</label>
                    <input type="text" name="banner_1_btn_link" value="{{ $banners['banner_1_btn_link'] ?? '' }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
            <button type="submit"
                class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-8 rounded-xl transition-all text-sm uppercase tracking-wider">
                Save Home Hero Text
            </button>
        </form>
    </div>

</div>
@endsection
