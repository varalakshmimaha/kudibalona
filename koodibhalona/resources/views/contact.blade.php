@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
@php
    $contactBanner = \App\Models\SiteSetting::get('contact_page_banner')
        ?: \App\Models\SiteSetting::get('banner_2_image');
@endphp

<style>
    /* Form field highlight styles */
    .contact-input {
        width: 100%;
        padding: 14px 18px;
        background: #fff;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        font-family: 'Outfit', sans-serif;
    }
    .contact-input::placeholder { color: #94a3b8; }
    .contact-input:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245,158,11,0.13);
        background: #fffbeb;
    }
    .contact-input:hover:not(:focus) {
        border-color: #fcd34d;
    }

    /* Info card icon circle */
    .info-icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255,255,255,0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-bottom: 14px;
    }

    /* Social icon button */
    .social-btn {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
    }
    .social-btn:hover { transform: translateY(-3px) scale(1.08); box-shadow: 0 6px 18px rgba(0,0,0,0.15); }
    .social-btn svg { width: 20px; height: 20px; }
</style>

<!-- Page Header with Background Image -->
<div class="relative py-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $contactBanner ? asset('storage/' . $contactBanner) : 'https://images.unsplash.com/photo-1516387938699-a93567ec168e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80' }}" alt="Contact Us Banner" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif">Contact Us</h1>
        <nav class="flex justify-center items-center gap-3 text-sm font-bold tracking-widest uppercase text-white/80">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">HOME</a>
            <span class="text-white/40">/</span>
            <span class="text-amber-500">CONTACT US</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">

        <!-- Left Side: Message & Socials -->
        <div class="space-y-8">
            <div class="relative pl-6">
                <svg class="w-6 h-6 text-amber-500 fill-current absolute top-0 left-0 -translate-y-2 opacity-30" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-2">Get in Touch With Us</h2>
                <p class="text-amber-600 font-bold tracking-widest uppercase text-xs">WRITE A MESSAGE</p>
            </div>

            <p class="text-slate-600 leading-relaxed text-lg">
                We'd love to hear from you! Whether you have questions, want to volunteer, or wish to support our initiatives, reach out to Koodibhalona Trust. Our team is always ready to assist and guide you.
            </p>

            <!-- Social Media Icons (inline SVG) -->
            <div class="flex flex-wrap gap-3 pt-2">
                <!-- Phone -->
                <a href="#" class="social-btn" style="background:#48C0C1;" title="Phone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.47 1.18 2 2 0 012.44 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.9a16 16 0 006.17 6.17l.76-.76a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="social-btn" style="background:#EE7254;" title="Facebook">
                    <svg viewBox="0 0 24 24" fill="white">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="social-btn" style="background:#FBC02D;" title="Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>
                <!-- YouTube -->
                <a href="#" class="social-btn" style="background:#A855F7;" title="YouTube">
                    <svg viewBox="0 0 24 24" fill="white">
                        <path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.54C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/>
                        <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#A855F7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Right Side: Contact Form -->
        <div class="space-y-5">
            @if(session('success'))
                <div class="p-4 bg-green-50 text-green-700 rounded-xl border border-green-200 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Full Name <span class="text-amber-500">*</span></label>
                        <input type="text" name="name" placeholder="e.g. Rahul Sharma" required class="contact-input">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Email Address <span class="text-amber-500">*</span></label>
                        <input type="email" name="email" placeholder="e.g. rahul@example.com" required class="contact-input">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Subject <span class="text-amber-500">*</span></label>
                    <input type="text" name="subject" placeholder="How can we help you?" required class="contact-input">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">Message <span class="text-amber-500">*</span></label>
                    <textarea name="message" rows="5" placeholder="Write your message here..." required class="contact-input" style="resize:vertical;"></textarea>
                </div>
                <div class="pt-1">
                    <button type="submit" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 px-10 rounded-xl shadow-lg transition-all uppercase tracking-widest text-xs hover:shadow-amber-200/60 hover:shadow-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-24">

        <!-- About Card -->
        <div class="rounded-2xl p-10 text-white flex flex-col justify-between min-h-[260px] shadow-xl transition-transform hover:-translate-y-1 hover:shadow-2xl" style="background: linear-gradient(135deg, #38b2b4 0%, #48C0C1 100%);">
            <div>
                <div class="info-icon-circle mb-4">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">About</h3>
                <p class="text-white/90 leading-relaxed text-sm font-medium">
                    Serving communities through education, health, welfare, and social development.
                </p>
            </div>
        </div>

        <!-- Address Card -->
        <div class="rounded-2xl p-10 text-white flex flex-col justify-between min-h-[260px] shadow-xl transition-transform hover:-translate-y-1 hover:shadow-2xl" style="background: linear-gradient(135deg, #e8634a 0%, #EE7254 100%);">
            <div>
                <div class="info-icon-circle mb-4">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">Address</h3>
                <p class="text-white/90 leading-relaxed text-sm font-medium">
                    No. 28, 1st Phase, 1st Cross, Teachers Colony,<br>
                    J.P. Nagar, Bangalore – 560078
                </p>
            </div>
        </div>

        <!-- Contact Card -->
        <div class="rounded-2xl p-10 text-white flex flex-col justify-between min-h-[260px] shadow-xl transition-transform hover:-translate-y-1 hover:shadow-2xl" style="background: linear-gradient(135deg, #e5a800 0%, #FBC02D 100%);">
            <div>
                <div class="info-icon-circle mb-4">
                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.47 1.18 2 2 0 012.44 0h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 7.9a16 16 0 006.17 6.17l.76-.76a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3 tracking-wide">Contact</h3>
                <div class="text-white/90 space-y-2 text-sm font-medium">
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 opacity-80" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        koodibhalona@gmail.com
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 opacity-80" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        96638 13500 / 89512 46888
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Banner Image -->
<div class="w-full h-[300px] md:h-[450px]">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Banner" class="w-full h-full object-cover">
</div>

@endsection
