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

        /* Hide Google Translate top bar/tooltips while keeping translation behavior */
        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner-frame,
        iframe.goog-te-banner-frame,
        #goog-gt-tt,
        .goog-te-balloon-frame,
        .goog-tooltip,
        .goog-text-highlight,
        body > .skiptranslate {
            display: none !important;
            visibility: hidden !important;
        }

        html, body {
            top: 0 !important;
            margin-top: 0 !important;
        }

        /* Keep default Google widget mounted but invisible */
        #google_translate_element {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            overflow: hidden !important;
            clip: rect(1px, 1px, 1px, 1px) !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .goog-te-gadget { font-size: 0 !important; }

        .language-float {
            position: fixed;
            right: 14px;
            bottom: 20px;
            z-index: 80;
            min-width: 96px;
        }
        .language-float-toggle {
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 9999px;
            border: 1px solid #f59e0b;
            background: linear-gradient(180deg, #ffffff 0%, #fff7ed 100%);
            color: #0f172a;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.16);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .language-float-toggle:hover {
            transform: translateY(-1px);
            border-color: #d97706;
            box-shadow: 0 12px 26px rgba(15, 23, 42, 0.18);
        }
        .language-float-toggle:focus-visible {
            outline: 2px solid #f59e0b;
            outline-offset: 2px;
        }
        .language-toggle-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            line-height: 1;
        }
        .language-globe {
            width: 16px;
            height: 16px;
            color: #b45309;
            flex-shrink: 0;
        }
        .language-caret {
            font-size: 10px;
            transition: transform 0.2s ease;
            color: #92400e;
        }
        .language-float.open .language-caret {
            transform: rotate(180deg);
        }
        .language-dropdown {
            position: absolute;
            right: 0;
            bottom: calc(100% + 10px);
            width: 170px;
            padding: 8px;
            border-radius: 12px;
            border: 1px solid #fde68a;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.15);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .language-option {
            width: 100%;
            display: block;
            text-align: left;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #0f172a;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
        }
        .language-option:hover {
            background: #f8fafc;
        }
        .language-option.active {
            background: #fff7ed;
            color: #b45309;
            font-weight: 700;
        }
        @media (max-width: 640px) {
            .language-float {
                right: 10px;
                bottom: 12px;
                min-width: 92px;
            }
            .language-dropdown {
                width: 154px;
            }
            .language-float-toggle {
                padding: 8px 11px;
            }
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
                    
                    <div class="flex items-center gap-3">
                        <div class="hidden md:flex items-center space-x-8">
                            <a href="{{ route('home') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('home') ? 'text-amber-600' : '' }}">Home</a>
                            <a href="{{ route('about') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('about') ? 'text-amber-600' : '' }}">About Us</a>
                            <a href="{{ route('services') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('services') ? 'text-amber-600' : '' }}">NGO Services</a>
                            <a href="{{ route('gallery') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('gallery') ? 'text-amber-600' : '' }}">Gallery</a>
                            <a href="{{ route('contact') }}" class="text-sm font-medium hover:text-amber-600 transition-colors {{ request()->routeIs('contact') ? 'text-amber-600' : '' }}">Contact Us</a>
                        </div>
                        <!-- Hidden Google Translate element -->
                        <div id="google_translate_element"></div>

                        <!-- Hamburger Button (mobile only) -->
                        <button id="mobile-menu-btn" class="md:hidden flex flex-col justify-center items-center w-10 h-10 rounded-lg border border-amber-200 bg-white/80 hover:bg-amber-50 hover:border-amber-400 transition-all gap-[5px] ml-1" aria-label="Open Menu" aria-expanded="false">
                            <span class="hamburger-line block w-6 h-[2px] bg-slate-700 rounded transition-all duration-300"></span>
                            <span class="hamburger-line block w-6 h-[2px] bg-slate-700 rounded transition-all duration-300"></span>
                            <span class="hamburger-line block w-6 h-[2px] bg-slate-700 rounded transition-all duration-300"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div id="mobile-menu" class="md:hidden hidden border-t border-amber-100 bg-white/98 backdrop-blur-md shadow-lg">
                <div class="px-4 py-3 flex flex-col gap-1">
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-amber-500 text-white' : 'text-slate-700 hover:bg-amber-50 hover:text-amber-600' }}">
                        <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-colors {{ request()->routeIs('about') ? 'bg-amber-500 text-white' : 'text-slate-700 hover:bg-amber-50 hover:text-amber-600' }}">
                        <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        About Us
                    </a>
                    <a href="{{ route('services') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-colors {{ request()->routeIs('services') ? 'bg-amber-500 text-white' : 'text-slate-700 hover:bg-amber-50 hover:text-amber-600' }}">
                        <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        NGO Services
                    </a>
                    <a href="{{ route('gallery') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-colors {{ request()->routeIs('gallery') ? 'bg-amber-500 text-white' : 'text-slate-700 hover:bg-amber-50 hover:text-amber-600' }}">
                        <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Gallery
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-colors {{ request()->routeIs('contact') ? 'bg-amber-500 text-white' : 'text-slate-700 hover:bg-amber-50 hover:text-amber-600' }}">
                        <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Contact Us
                    </a>
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

                <!-- Footer Bottom -->
                <div class="pt-10 border-t border-gray-700/50 flex flex-col md:flex-row justify-between items-center gap-8">
                    <p class="text-sm text-gray-500">
                        {{ \App\Models\SiteSetting::get('footer_text', '© 2025 Koodibhalona Trust. All Rights Reserved.') }}
                    </p>
                    

                </div>
            </div>
        </footer>
    </div>

    <!-- Language Switcher -->
    <div class="language-float notranslate" id="language-switcher" aria-label="Language Switcher" translate="no">
        <button type="button" class="language-float-toggle" id="language-toggle-btn" aria-haspopup="true" aria-expanded="false" aria-controls="language-dropdown">
            <span class="language-toggle-label">
                <svg class="language-globe" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M3 12H21M12 3C14.6 5.4 14.6 18.6 12 21M12 3C9.4 5.4 9.4 18.6 12 21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
                <span id="language-current-code">ENG</span>
            </span>
            <span class="language-caret" aria-hidden="true">▼</span>
        </button>
        <div class="language-dropdown hidden" id="language-dropdown" role="menu">
            <button type="button" class="language-option" onclick="setLanguage('en')" data-lang="en" role="menuitem">ENG</button>
            <button type="button" class="language-option" onclick="setLanguage('kn')" data-lang="kn" role="menuitem">KAN</button>
            <button type="button" class="language-option" onclick="setLanguage('hi')" data-lang="hi" role="menuitem">HIN</button>
            <button type="button" class="language-option" onclick="setLanguage('te')" data-lang="te" role="menuitem">TEL</button>
            <button type="button" class="language-option" onclick="setLanguage('ta')" data-lang="ta" role="menuitem">TAM</button>
        </div>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,kn,hi,te,ta',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

        

    <script>
        // Safely check if lucide is loaded before creating icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            const btt = document.getElementById('back-to-top');

            if (navbar && btt) {
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
            }

            // Hamburger menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                const hamburgerLines = document.querySelectorAll('.hamburger-line');
                
                mobileMenuBtn.addEventListener('click', function() {
                    const isOpen = !mobileMenu.classList.contains('hidden');
                    if (isOpen) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuBtn.setAttribute('aria-expanded', 'false');
                        if(hamburgerLines.length >= 3) {
                            hamburgerLines[0].style.transform = '';
                            hamburgerLines[1].style.opacity = '1';
                            hamburgerLines[2].style.transform = '';
                        }
                    } else {
                        mobileMenu.classList.remove('hidden');
                        mobileMenuBtn.setAttribute('aria-expanded', 'true');
                        if(hamburgerLines.length >= 3) {
                            hamburgerLines[0].style.transform = 'translateY(7px) rotate(45deg)';
                            hamburgerLines[1].style.opacity = '0';
                            hamburgerLines[2].style.transform = 'translateY(-7px) rotate(-45deg)';
                        }
                    }
                });

                // Close mobile menu when a nav link is clicked
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        mobileMenuBtn.setAttribute('aria-expanded', 'false');
                        if(hamburgerLines.length >= 3) {
                            hamburgerLines[0].style.transform = '';
                            hamburgerLines[1].style.opacity = '1';
                            hamburgerLines[2].style.transform = '';
                        }
                    });
                });
            }
        });

        // ── Language Switcher ──────────────────────────────────────
        const LANGUAGE_LABELS = {
            en: 'ENG',
            kn: 'KAN',
            hi: 'HIN',
            te: 'TEL',
            ta: 'TAM'
        };

        function getCookieValue(name) {
            const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
            return match ? decodeURIComponent(match[1]) : '';
        }

        function getSavedLanguage() {
            const local = localStorage.getItem('site_lang');
            if (local && LANGUAGE_LABELS[local]) return local;

            const siteLang = getCookieValue('site_lang');
            if (siteLang && LANGUAGE_LABELS[siteLang]) return siteLang;

            const goog = getCookieValue('googtrans');
            if (goog) {
                const parts = goog.split('/');
                const lang = parts[2] || '';
                if (lang && LANGUAGE_LABELS[lang]) return lang;
            }

            return 'en';
        }

        function updateLanguageUI(lang) {
            document.querySelectorAll('.language-option').forEach(option => {
                option.classList.toggle('active', option.dataset.lang === lang);
            });
            const currentCode = document.getElementById('language-current-code');
            if (currentCode) {
                currentCode.textContent = LANGUAGE_LABELS[lang] || 'ENG';
            }
        }

        function initLanguageDropdown() {
            const wrapper = document.getElementById('language-switcher');
            const toggleBtn = document.getElementById('language-toggle-btn');
            const dropdown = document.getElementById('language-dropdown');

            if (!wrapper || !toggleBtn || !dropdown || wrapper.dataset.initialized === '1') {
                return;
            }
            wrapper.dataset.initialized = '1';

            function closeDropdown() {
                wrapper.classList.remove('open');
                dropdown.classList.add('hidden');
                toggleBtn.setAttribute('aria-expanded', 'false');
            }

            toggleBtn.addEventListener('click', function(event) {
                event.stopPropagation();
                const isOpen = !dropdown.classList.contains('hidden');
                if (isOpen) {
                    closeDropdown();
                } else {
                    wrapper.classList.add('open');
                    dropdown.classList.remove('hidden');
                    toggleBtn.setAttribute('aria-expanded', 'true');
                }
            });

            document.addEventListener('click', function(event) {
                if (!wrapper.contains(event.target)) {
                    closeDropdown();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeDropdown();
                }
            });
        }

        function hideGoogleTranslateChrome() {
            document.body.style.top = '0px';
            document.documentElement.style.top = '0px';

            document.querySelectorAll(
                '.goog-te-banner-frame, iframe.goog-te-banner-frame, .goog-te-balloon-frame, #goog-gt-tt, .goog-tooltip, .goog-text-highlight, body > .skiptranslate'
            ).forEach(function(node) {
                node.style.display = 'none';
                node.style.visibility = 'hidden';
            });
        }

        function setLanguage(lang) {
            // Save preference
            localStorage.setItem('site_lang', lang);
            document.cookie = "site_lang=" + lang + "; path=/; max-age=31536000";
            
            // Set Google Translate cookie directly
            if (lang === 'en') {
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + window.location.hostname;
            } else {
                document.cookie = "googtrans=/en/" + lang + "; path=/;";
                document.cookie = "googtrans=/en/" + lang + "; path=/; domain=" + window.location.hostname;
            }

            updateLanguageUI(lang);
            hideGoogleTranslateChrome();

            // Reload to apply language from a clean DOM state
            window.location.reload();
        }

        // Restore saved language on page load gracefully
        setTimeout(function() {
            var saved = getSavedLanguage();
            window.currentLanguage = saved;
            updateLanguageUI(saved);
            initLanguageDropdown();
            hideGoogleTranslateChrome();
        }, 50);

        window.addEventListener('load', function() {
            hideGoogleTranslateChrome();
            setTimeout(hideGoogleTranslateChrome, 300);
            setTimeout(hideGoogleTranslateChrome, 1200);
        });

        const gtUiObserver = new MutationObserver(function() {
            hideGoogleTranslateChrome();
        });
        gtUiObserver.observe(document.documentElement, { childList: true, subtree: true, attributes: true, attributeFilter: ['style', 'class'] });
    </script>

    {{-- Kannada brand-name correction: runs after Google Translate may have altered the DOM --}}
    @php
        $siteLang = $_COOKIE['site_lang'] ?? null;
        if (!$siteLang && isset($_COOKIE['googtrans'])) {
            $parts = explode('/', trim($_COOKIE['googtrans'], '/'));
            $siteLang = $parts[1] ?? 'en';
        }
        $siteLang = $siteLang ?: 'en';
    @endphp
    @if($siteLang === 'kn')
    <script>
        (function() {
            const CORRECT = 'ಕೂಡಿಬಾಳೋಣ';
            const WRONG_VARIANTS = [
                'ಕೂಡಿಭಲೋನಾ','ಕೂಡಿಭಲೋನ','ಕೂಡಿಬಲೋನಾ','ಕೂಡಿಬಲೋನ',
                'ಕೂಡಿಬಲೊನ','ಕೂಡಿಬಾಲೋಣ','ಕೂಡಿಬಾಲೋನ','ಕೂಡಿಭಾಲೋನ',
                'ಕೂಡಿಭಾಳೋಣ','ಕೂಡಿಭಾಳೋನ','Koodibhalona','koodibhalona'
            ];
            const WRONG_REGEX = /ಕೂಡಿ[ಭಬ][ಾ]?ಲ[ೋೊ][ನಣ][ಾ]?/g;

            function fixNode(node) {
                if (!node.nodeValue) return;
                let txt = node.nodeValue;
                let changed = false;
                for (const w of WRONG_VARIANTS) {
                    if (txt.includes(w)) { txt = txt.split(w).join(CORRECT); changed = true; }
                }
                const fixed = txt.replace(WRONG_REGEX, CORRECT);
                if (fixed !== txt) { txt = fixed; changed = true; }
                if (changed) node.nodeValue = txt;
            }

            function fixAll() {
                const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
                let n;
                while ((n = walker.nextNode())) {
                    if (n.parentNode && ['SCRIPT','STYLE','NOSCRIPT'].includes(n.parentNode.nodeName)) continue;
                    fixNode(n);
                }
            }

            // Run immediately and after small delays for GT to settle
            fixAll();
            setTimeout(fixAll, 500);
            setTimeout(fixAll, 1500);
            setTimeout(fixAll, 3000);

            // Watch for Google Translate DOM mutations
            const obs = new MutationObserver(function(mutations) {
                obs.disconnect();
                for (const m of mutations) {
                    for (const node of m.addedNodes) {
                        if (node.nodeType === Node.TEXT_NODE) fixNode(node);
                        else if (node.nodeType === Node.ELEMENT_NODE) {
                            const walker = document.createTreeWalker(node, NodeFilter.SHOW_TEXT, null, false);
                            let n; while ((n = walker.nextNode())) fixNode(n);
                        }
                    }
                    if (m.type === 'characterData') fixNode(m.target);
                }
                obs.observe(document.body, { childList: true, subtree: true, characterData: true });
            });
            obs.observe(document.body, { childList: true, subtree: true, characterData: true });
        })();
    </script>
    @endif
</body>
</html>
