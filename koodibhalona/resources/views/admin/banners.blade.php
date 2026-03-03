@extends('layouts.admin')

@section('title', 'Manage Banners')
@section('header', 'Page Banners')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-xl p-4 text-sm flex items-start gap-3">
        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <strong>Banner Tips:</strong> Upload wide images (recommended 1920×600 px). The title and subtitle will appear as text overlay on the banner. Leave fields empty to use default content.
        </div>
    </div>

    <form action="{{ route('admin.banners.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- ─── Banner 1: Home Page ─── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-amber-50/60 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-sm">1</span>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Home Page Banner</h3>
                    <p class="text-gray-500 text-xs mt-0.5">Shown at the top of the Home page as the main hero banner.</p>
                </div>
            </div>
            <div class="p-8 space-y-6">

                {{-- Preview --}}
                @php $b1img = $banners['banner_1_image'] ?? null; @endphp
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700">Banner Image</label>
                    @if($b1img)
                        <div class="relative w-full h-40 rounded-xl overflow-hidden border border-gray-200 bg-gray-100">
                            <img src="{{ asset('storage/' . $b1img) }}" alt="Banner 1" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 flex items-end p-4">
                                <span class="text-white text-xs font-semibold">Current banner image</span>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-40 rounded-xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400 gap-2">
                            <i data-lucide="image" class="w-10 h-10"></i>
                            <span class="text-sm">No banner uploaded yet</span>
                        </div>
                    @endif
                    <input type="file" name="banner_1_image" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all">
                    <p class="text-[10px] text-gray-400">Recommended: 1920×600 px, JPG or PNG.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Banner Title</label>
                        <input type="text" name="banner_1_title" value="{{ $banners['banner_1_title'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. Welcome to Koodibhalona Trust">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Banner Subtitle</label>
                        <input type="text" name="banner_1_subtitle" value="{{ $banners['banner_1_subtitle'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. Serving Humanity with Compassion">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Button Text</label>
                        <input type="text" name="banner_1_btn_text" value="{{ $banners['banner_1_btn_text'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. Learn More">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Button Link (URL)</label>
                        <input type="text" name="banner_1_btn_link" value="{{ $banners['banner_1_btn_link'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. /about">
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── Banner 2: About / Other Pages ─── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-slate-50/60 flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-slate-700 text-white flex items-center justify-center font-bold text-sm">2</span>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Secondary Banner</h3>
                    <p class="text-gray-500 text-xs mt-0.5">Used on inner pages (About, Services, Gallery, Contact) as the top page header banner.</p>
                </div>
            </div>
            <div class="p-8 space-y-6">

                @php $b2img = $banners['banner_2_image'] ?? null; @endphp
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700">Banner Image</label>
                    @if($b2img)
                        <div class="relative w-full h-40 rounded-xl overflow-hidden border border-gray-200 bg-gray-100">
                            <img src="{{ asset('storage/' . $b2img) }}" alt="Banner 2" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 flex items-end p-4">
                                <span class="text-white text-xs font-semibold">Current banner image</span>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-40 rounded-xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400 gap-2">
                            <i data-lucide="image" class="w-10 h-10"></i>
                            <span class="text-sm">No banner uploaded yet</span>
                        </div>
                    @endif
                    <input type="file" name="banner_2_image" accept="image/*"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all">
                    <p class="text-[10px] text-gray-400">Recommended: 1920×600 px, JPG or PNG.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Banner Title</label>
                        <input type="text" name="banner_2_title" value="{{ $banners['banner_2_title'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. About Our Trust">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Banner Subtitle</label>
                        <input type="text" name="banner_2_subtitle" value="{{ $banners['banner_2_subtitle'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. Learn more about our mission">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Button Text</label>
                        <input type="text" name="banner_2_btn_text" value="{{ $banners['banner_2_btn_text'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. Contact Us">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Button Link (URL)</label>
                        <input type="text" name="banner_2_btn_link" value="{{ $banners['banner_2_btn_link'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="e.g. /contact">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg shadow-amber-500/20 transform hover:-translate-y-0.5 transition-all uppercase tracking-widest text-xs">
                Save All Banners
            </button>
        </div>
    </form>
</div>
@endsection
