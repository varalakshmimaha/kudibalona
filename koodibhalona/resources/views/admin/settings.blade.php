@extends('layouts.admin')

@section('title', 'Site Settings')
@section('header', 'Settings')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-xl font-bold text-gray-800">General Settings</h3>
            <p class="text-gray-500 text-sm mt-1">Manage your website's primary information and branding.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <!-- Logo Section -->
            <div class="space-y-4 pb-6 border-b border-gray-100">
                <label class="block text-sm font-bold text-gray-700">Site Logo</label>
                <div class="flex items-center gap-8">
                    @if($settings['site_logo'])
                        <div class="w-24 h-24 rounded-full border border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        <div class="w-24 h-24 rounded-full border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-300">
                            <i data-lucide="image" class="w-8 h-8"></i>
                        </div>
                    @endif
                    <div class="flex-grow">
                        <input type="file" name="site_logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all">
                        <p class="text-[10px] text-gray-400 mt-2">Recommended: Circular or square PNG/SVG with transparent background.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pb-6 border-b border-gray-100">
                <label class="block text-sm font-bold text-gray-700">Home Page Banner Image</label>
                <div class="flex items-center gap-8">
                    @if(!empty($settings['home_banner_image']))
                        <div class="w-48 h-24 rounded-xl border border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $settings['home_banner_image']) }}" alt="Home Banner" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-48 h-24 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-300">
                            <i data-lucide="image" class="w-8 h-8"></i>
                        </div>
                    @endif
                    <div class="flex-grow">
                        <input type="file" name="home_banner_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all">
                        <p class="text-[10px] text-gray-400 mt-2">Used for the home page hero banner. Recommended wide image (e.g. 1920x700).</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Name -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700">Site Name</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="e.g. Koodibhalona Trust">
                </div>

                <!-- Site Tagline -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700">Site Tagline</label>
                    <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="e.g. Serving Humanity">
                </div>
            </div>

            <!-- Footer About -->
            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700">Footer "About Us" Description</label>
                <textarea name="footer_about" rows="3"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                    placeholder="Brief description for the footer...">{{ $settings['footer_about'] }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Footer Text -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700">Footer Attribution</label>
                    <input type="text" name="footer_text" value="{{ $settings['footer_text'] }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="e.g. © 2025 Koodibhalona Trust. All Rights Reserved.">
                </div>

                <!-- Quote Text -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700">Homepage Quote</label>
                    <input type="text" name="quote_text" value="{{ $settings['quote_text'] }}" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="Inspirational quote...">
                </div>
            </div>

            @php $cinfo = \App\Models\ContactInfo::first(); @endphp
            @if($cinfo)
            <div class="pt-8 border-t border-gray-100 mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Contact & Address Settings</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ $cinfo->address }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Primary Email</label>
                        <input type="email" name="email" value="{{ $cinfo->email }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Phone Number</label>
                        <input type="text" name="phone" value="{{ $cinfo->phone }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700">Secondary Phone</label>
                        <input type="text" name="phone2" value="{{ $cinfo->phone2 }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-100 mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Social Media Links</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 flex items-center"><i data-lucide="facebook" class="w-4 h-4 mr-2 text-blue-600"></i> Facebook URL</label>
                        <input type="url" name="facebook" value="{{ $cinfo->facebook }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="https://facebook.com/...">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 flex items-center"><i data-lucide="instagram" class="w-4 h-4 mr-2 text-pink-600"></i> Instagram URL</label>
                        <input type="url" name="instagram" value="{{ $cinfo->instagram }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="https://instagram.com/...">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 flex items-center"><i data-lucide="youtube" class="w-4 h-4 mr-2 text-red-600"></i> YouTube URL</label>
                        <input type="url" name="youtube" value="{{ $cinfo->youtube }}" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="https://youtube.com/...">
                    </div>
                </div>
            </div>
            @endif

            <div class="pt-8 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg shadow-amber-500/20 transform hover:-translate-y-0.5 transition-all uppercase tracking-widest text-xs">
                    Apply All Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
