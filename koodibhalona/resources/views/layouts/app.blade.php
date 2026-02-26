<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome') | {{ \App\Models\SiteSetting::get('site_name', 'Koodibhalona Trust') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lucide/web"></script>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .dark .glass {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #B8860B 0%, #FFD700 50%, #DAA520 100%);
        }

        .text-gold {
            background: linear-gradient(135deg, #B8860B 0%, #FFD700 50%, #DAA520 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Correctly hide Google Translate Top Bar */
        .goog-te-banner-frame.skiptranslate, 
        .goog-te-banner-frame, 
        #goog-gt-tt,
        .goog-te-balloon-frame { 
            display: none !important; 
        }
        
        body { top: 0px !important; }
        
        /* Custom Styling for Translate Dropdown */
        .goog-te-gadget { 
            font-family: 'Outfit', sans-serif !important; 
            color: transparent !important;
            font-size: 0 !important;
        }
        
        .goog-te-gadget .goog-te-combo {
            padding: 10px 40px 10px 20px !important;
            border-radius: 9999px !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #fff !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            outline: none !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            margin: 0 !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.7)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        }
        
        .goog-te-gadget .goog-te-combo:hover,
        .goog-te-gadget .goog-te-combo:focus { 
            border-color: #F59E0B !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        .goog-logo-link, .goog-te-gadget-icon { display: none !important; }
        #google_translate_element { 
            display: inline-block !important;
        }
    </style>
</head>
<body class="antialiased bg-white text-slate-900 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="fixed w-full z-50 transition-all duration-300 glass border-b border-gray-100" id="navbar">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            @if($logo = \App\Models\SiteSetting::get('site_logo'))
                                <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-14 w-14 object-contain">
                            @endif
                            <div class="flex flex-col">
                                <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white uppercase">
                                    {{ \App\Models\SiteSetting::get('site_name', 'Koodibhalona Trust') }}
                                </span>
                                <span class="text-[10px] text-slate-500 dark:text-amber-500 font-medium">
                                    {!! \App\Models\SiteSetting::get('site_tagline', '') !!}
                                </span>
                            </div>
                        </a>
                    </div>
                    
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('home') ? 'text-amber-600' : '' }}">Home</a>
                        <a href="{{ route('about') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('about') ? 'text-amber-600' : '' }}">About Us</a>
                        <a href="{{ route('services') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('services') ? 'text-amber-600' : '' }}">NGO Services</a>
                        <a href="{{ route('gallery') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('gallery') ? 'text-amber-600' : '' }}">Gallery</a>
                        <a href="{{ route('contact') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('contact') ? 'text-amber-600' : '' }}">Contact Us</a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-slate-500 hover:text-slate-900 focus:outline-none">
                            <i data-lucide="menu"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 absolute w-full shadow-xl">
                <div class="px-4 pt-2 pb-6 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-bold text-slate-800 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-600' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="block px-4 py-3 text-base font-bold text-slate-800 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-colors {{ request()->routeIs('about') ? 'bg-amber-50 text-amber-600' : '' }}">About Us</a>
                    <a href="{{ route('services') }}" class="block px-4 py-3 text-base font-bold text-slate-800 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-colors {{ request()->routeIs('services') ? 'bg-amber-50 text-amber-600' : '' }}">NGO Services</a>
                    <a href="{{ route('gallery') }}" class="block px-4 py-3 text-base font-bold text-slate-800 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-colors {{ request()->routeIs('gallery') ? 'bg-amber-50 text-amber-600' : '' }}">Gallery</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-3 text-base font-bold text-slate-800 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-colors {{ request()->routeIs('contact') ? 'bg-amber-50 text-amber-600' : '' }}">Contact Us</a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow pt-20">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-[#333333] text-gray-300 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 pb-16">
                    <!-- About Us -->
                    <div class="space-y-6">
                        <h4 class="text-amber-500 font-bold text-lg">About Us</h4>
                        <p class="text-sm leading-relaxed text-gray-400">
                            {{ \App\Models\SiteSetting::get('footer_about', 'We are dedicated to uplifting underserved communities through education, healthcare, and support programs that inspire hope and lasting change.') }}
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-6">
                        <h4 class="text-amber-500 font-bold text-lg">Quick Links</h4>
                        <ul class="space-y-4 text-sm">
                            <li><a href="{{ route('home') }}" class="hover:text-amber-500 transition-colors">Home</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-amber-500 transition-colors">About Us</a></li>
                            <li><a href="{{ route('services') }}" class="hover:text-amber-500 transition-colors">NGO Services</a></li>
                            <li><a href="{{ route('gallery') }}" class="hover:text-amber-500 transition-colors">Gallery</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-amber-500 transition-colors">Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="space-y-6">
                        <h4 class="text-amber-500 font-bold text-lg">Contact</h4>
                        @php $cinfo = \App\Models\ContactInfo::first(); @endphp
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start">
                                <span class="break-all italic">Email: {{ $cinfo?->email }}</span>
                            </li>
                            <li class="flex items-start">
                                <span>Phone: +91 {{ $cinfo?->phone }}</span>
                            </li>
                            <li class="flex items-start">
                                <span class="leading-relaxed">Address: {{ $cinfo?->address }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Icons -->
                    <div class="flex items-start gap-4 pt-12 md:pt-0">
                        @if($cinfo?->facebook)
                            <a href="{{ $cinfo->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-[#4267B2] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                        @endif
                        @if($cinfo?->instagram)
                            <a href="{{ $cinfo->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-[#E1306C] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                        @endif
                        @if($cinfo?->youtube)
                            <a href="{{ $cinfo->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-[#FF0000] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <i data-lucide="youtube" class="w-5 h-5"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Footer Bottom & Google Translate -->
                <div class="pt-10 border-t border-gray-700/50 flex flex-col md:flex-row justify-between items-center gap-8">
                    <p class="text-sm text-gray-500">
                        {{ \App\Models\SiteSetting::get('footer_text', '© 2025 Koodibhalona Trust. All Rights Reserved.') }}
                    </p>
                    
                    <!-- Language & Scroll Top -->
                    <div class="flex items-center gap-6">
                        <div id="google_translate_element" class="rounded-md"></div>
                        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center hover:border-amber-500 hover:text-amber-500 transition-all">
                            <i data-lucide="arrow-up" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'hi,kn,ta,te,en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <button id="back-to-top" class="fixed bottom-8 right-8 z-50 w-12 h-12 bg-amber-600 text-white rounded-full shadow-2xl items-center justify-center hidden hover:scale-110 active:scale-95 transition-all group">
        <i data-lucide="chevron-up" class="w-6 h-6 group-hover:-translate-y-1 transition-transform"></i>
    </button>

    <script>
        lucide.createIcons();
        const navbar = document.getElementById('navbar');
        const btt = document.getElementById('back-to-top');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-xl', 'bg-white/95');
                navbar.classList.remove('bg-white/80');
            } else {
                navbar.classList.remove('shadow-xl', 'bg-white/95');
                navbar.classList.add('bg-white/80');
            }

            if (window.scrollY > 300) {
                btt.classList.remove('hidden');
                btt.classList.add('flex');
            } else {
                btt.classList.add('hidden');
                btt.classList.remove('flex');
            }
        });

        btt.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const menuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if(menuBtn) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }


{{-- Custom Translation Override Logic --}}
@php
    $translations = \App\Models\CustomTranslation::where('is_hidden', false)
        ->pluck('kannada_word', 'english_word')
        ->toArray();
@endphp

<script>
    window.customTranslationsMapping = @json($translations);

    function applyCustomTranslations() {
        const map = window.customTranslationsMapping || {};
        if (Object.keys(map).length === 0) return;

        const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
        let node;

        while ((node = walker.nextNode())) {
            if (!node.nodeValue || node.nodeValue.trim() === '') continue;

            let text = node.nodeValue;
            let modified = false;

            // Replace English -> Kannada custom words from admin panel
            for (const [english, kannada] of Object.entries(map)) {
                const escaped = english.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(escaped, "gi");
                if (regex.test(text)) {
                    text = text.replace(regex, kannada);
                    modified = true;
                }
            }

            // Fix common wrong Kannada outputs from Google Translate
            const badTranslationMap = {
                "ಕೂಡಿಭಲೋನಾ": "ಕೂಡಿಬಾಳೋಣ",
                "ಕೂಡಿಬಲೊನ": "ಕೂಡಿಬಾಳೋಣ"
            };
            for (const [bad, good] of Object.entries(badTranslationMap)) {
                if (text.includes(bad)) {
                    text = text.split(bad).join(good);
                    modified = true;
                }
            }

            if (modified) node.nodeValue = text;
        }
    }

    const observer = new MutationObserver((mutations) => {
        let shouldApply = false;
        for (const mutation of mutations) {
            if (mutation.type === 'characterData') { shouldApply = true; break; }
            if (mutation.type === 'childList' && mutation.addedNodes.length) { shouldApply = true; break; }
        }
        if (shouldApply) {
            observer.disconnect();
            applyCustomTranslations();
            observer.observe(document.body, { childList: true, subtree: true, characterData: true });
        }
    });

    observer.observe(document.body, { childList: true, subtree: true, characterData: true });
    setTimeout(applyCustomTranslations, 500);
</script>
</body>
</html>
