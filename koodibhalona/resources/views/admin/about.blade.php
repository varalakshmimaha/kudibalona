@extends('layouts.admin')

@section('title', 'Manage About Us')
@section('header', 'About Us Page Content')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
        @csrf

        <div class="pb-8 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">About Page Banner</h3>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Hero Banner Image</label>
                @if(!empty($settings['about_banner_image']))
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $settings['about_banner_image']) }}" alt="About Banner Preview" class="h-32 rounded-lg border">
                </div>
                @endif
                <input type="file" name="about_banner_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100 transition-colors cursor-pointer border border-gray-200 rounded-xl bg-gray-50 h-[46px] flex items-center">
                <p class="text-xs text-gray-500 mt-2">Used in the top hero section of the About Us page. Recommended wide image (e.g. 1920x700).</p>
            </div>
        </div>
        
        <!-- Sanatana Gyana Kirana Section -->
        <div class="pb-8 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Sanatana Gyana Kirana Section</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kannada Text <span class="text-red-500">*</span></label>
                    <textarea name="about_santana_kannada" rows="6" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_santana_kannada'] ?? '' }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description Paragraph 1 <span class="text-red-500">*</span></label>
                        <textarea name="about_santana_desc1" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_santana_desc1'] ?? "At Sanatana Jnanakendra, we are devoted to preserving and spreading the essence of Sanatana Dharma..." }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description Paragraph 2 <span class="text-red-500">*</span></label>
                        <textarea name="about_santana_desc2" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_santana_desc2'] ?? "As a spiritual and religious trust, our mission is to revive the sacred values..." }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Section Image</label>
                    @if(!empty($settings['about_santana_image']))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $settings['about_santana_image']) }}" alt="Preview" class="h-32 rounded-lg border">
                    </div>
                    @endif
                    <input type="file" name="about_santana_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100 transition-colors cursor-pointer border border-gray-200 rounded-xl bg-gray-50 h-[46px] flex items-center">
                </div>
            </div>
        </div>

        <!-- Founder Profiles -->
        <div class="pb-8 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Founder Self Introduction</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">About Founder <span class="text-red-500">*</span></label>
                    <textarea name="about_founder_intro" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_founder_intro'] ?? '' }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Founder Photo 1</label>
                        @if(!empty($settings['about_founder_photo1']))
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $settings['about_founder_photo1']) }}" alt="Preview" class="h-32 rounded-lg border">
                        </div>
                        @endif
                        <input type="file" name="about_founder_photo1" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100 border border-gray-200 rounded-xl bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Founder Photo 2</label>
                        @if(!empty($settings['about_founder_photo2']))
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $settings['about_founder_photo2']) }}" alt="Preview" class="h-32 rounded-lg border">
                        </div>
                        @endif
                        <input type="file" name="about_founder_photo2" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100 border border-gray-200 rounded-xl bg-gray-50">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Quote Tagline <span class="text-red-500">*</span></label>
                        <input type="text" name="about_founder_quote" value="{{ $settings['about_founder_quote'] ?? 'My trust Moto is love all server all. Leave together.' }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Quote Description <span class="text-red-500">*</span></label>
                        <textarea name="about_founder_quote_desc" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_founder_quote_desc'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Vision & Mission -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-6">Vision & Mission</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Vision Statement <span class="text-red-500">*</span></label>
                    <textarea name="about_vision" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_vision'] ?? 'A society where every individual has access to education, healthcare, equality, and opportunities to thrive with dignity.' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mission Statement <span class="text-red-500">*</span></label>
                    <textarea name="about_mission" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors" required>{{ $settings['about_mission'] ?? 'Empower communities through education, health, welfare, and environmental programs, creating lasting impact.' }}</textarea>
                </div>
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="px-8 py-3 bg-amber-500 text-white rounded-xl font-bold shadow-lg shadow-amber-500/30 hover:bg-amber-600 transition-colors">
                Save About Us Settings
            </button>
        </div>
    </form>
</div>
@endsection
