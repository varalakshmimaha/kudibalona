@extends('layouts.app')

@section('title', 'Home')

@section('content')
@php $homeBanner = \App\Models\SiteSetting::get('home_banner_image'); @endphp

<!-- Page Header with Background Image -->
<div class="relative py-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $homeBanner ? asset('storage/' . $homeBanner) : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80' }}" alt="Home Banner" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif">Welcome to {{ \App\Models\SiteSetting::get('site_name', 'Koodibhalona Trust') }}</h1>
        <nav class="flex justify-center items-center gap-3 text-sm font-bold tracking-widest uppercase text-white/80">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">HOME</a>
            <span class="text-white/40">/</span>
            <span class="text-amber-500">WELCOME</span>
        </nav>
    </div>
</div>

<!-- Hero Section -->
<div class="relative overflow-hidden bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 min-h-[70vh] flex flex-col justify-center">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                @foreach($slides as $slide)
                <div class="sm:text-center lg:text-left transition-all duration-700">
                    <h2 class="text-sm font-semibold tracking-wide text-amber-600 uppercase mb-2">{{ $slide->label }}</h2>
                    <h1 class="text-4xl tracking-tight font-extrabold text-slate-900 sm:text-5xl md:text-6xl mb-6">
                        <span class="block xl:inline">{{ $slide->title }}</span>
                        @if($slide->subtitle)
                        <span class="block text-amber-600 xl:inline">{{ $slide->subtitle }}</span>
                        @endif
                    </h1>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="{{ $slide->button_link }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white gold-gradient md:py-4 md:text-lg md:px-10 transition-transform hover:scale-105">
                                {{ $slide->button_text }}
                            </a>
                        </div>
                    </div>
                </div>
                @break {{-- Only show first for now as a simple implementation --}}
                @endforeach
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Charity">
    </div>
</div>

<!-- About Summary -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <div class="relative">
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Our Work" class="w-full h-auto">
                </div>
                <div class="absolute -bottom-6 -right-6 w-32 h-32 gold-gradient rounded-full opacity-20 -z-0"></div>
            </div>
            <div class="mt-12 lg:mt-0">
                <h3 class="text-amber-600 font-bold tracking-wider uppercase text-sm mb-3">About Koodibhalona Trust</h3>
                <h2 class="text-4xl font-bold text-slate-900 mb-6 leading-tight">Empowering Communities, Changing Lives.</h2>
                <div class="space-y-6 text-slate-600 text-lg">
                    <p>Koodibhalona Trust is a public charitable organization based in Bangalore, Karnataka, founded with a vision to serve humanity beyond the boundaries of caste, creed, gender, or religion.</p>
                    <p>Established by Mr. Sai Jay Shankar B.C., the Trust is committed to creating a compassionate and inclusive society through impactful initiatives that touch every aspect of human life.</p>
                </div>
                <div class="mt-10">
                    <a href="{{ route('about') }}" class="inline-flex items-center text-amber-600 font-semibold hover:text-amber-700 transition-colors">
                        Discover more about us
                        <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Objectives Section -->
<section class="py-24 bg-[#fbfbfd] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-start">
            <!-- Left Side: Images & Video -->
            <div class="space-y-10">
                <div class="text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 space-y-2 mb-6 font-serif">Objectives of Koodibhalona Trust</h2>
                    <p class="text-slate-600 text-lg leading-[1.8] font-medium">
                        The Trust is established for public charitable purposes and shall function to serve society without discrimination of caste, creed, gender, or religion. Its objectives include:
                    </p>
                </div>

                <div class="rounded-[20px] overflow-hidden shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#efefef] bg-white">
                    <img src="{{ $objective->image ? asset('storage/' . $objective->image) : 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80' }}" alt="Impact" class="w-full h-auto object-cover">
                </div>

                @if($objective->youtube_url)
                <div class="rounded-[20px] overflow-hidden shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#efefef] bg-white">
                    <div class="aspect-video">
                        @php
                            $youtubeUrl = $objective->youtube_url;
                            if (str_contains($youtubeUrl, 'watch?v=')) {
                                $youtubeUrl = str_replace('watch?v=', 'embed/', $youtubeUrl);
                                $youtubeUrl = explode('&', $youtubeUrl)[0];
                            } elseif (str_contains($youtubeUrl, 'youtu.be/')) {
                                $youtubeUrl = str_replace('youtu.be/', 'youtube.com/embed/', $youtubeUrl);
                                $youtubeUrl = explode('?', $youtubeUrl)[0];
                            }
                        @endphp
                        <iframe class="w-full h-full" src="{{ $youtubeUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: List of Objectives -->
            <div class="mt-12 lg:mt-0">
                <div class="bg-white rounded-[22px] shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#eaeaea] p-6 sm:p-8 lg:p-10 flex flex-col">
                    <h3 class="text-2xl font-bold font-serif text-slate-900 mb-4 border-b border-gray-100 pb-3">Our Key Focus Areas</h3>
                    <div class="divide-y divide-gray-100">
                        @foreach(array_slice($objective->list_items, 0, 8) as $index => $item)
                        <div class="flex items-start gap-3 py-3 group cursor-default">
                            <span class="text-amber-500 font-bold text-lg leading-tight mt-0.5">›</span>
                            <p class="text-slate-700 font-medium leading-relaxed group-hover:text-slate-900 transition-colors">{{ $item }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h3 class="text-amber-600 font-bold tracking-wider uppercase text-sm mb-3">What We Do</h3>
            <h2 class="text-4xl font-bold text-slate-900">Our Core Initiatives</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col items-center group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-amber-50/50 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                <div class="relative w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center mb-6 shadow-sm p-1">
                    <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-full h-full object-cover rounded-xl" alt="icon">
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3 text-center font-serif relative z-10">{{ $service->title }}</h4>
                <p class="text-slate-600 text-sm line-clamp-3 mb-6 text-center leading-relaxed relative z-10">{{ $service->description }}</p>
                <div class="mt-auto w-full pt-4 border-t border-slate-100 flex items-center justify-between relative z-10">
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase tracking-wider">{{ explode(' · ', $service->tag)[0] }}</span>
                    <a href="{{ route('services') }}" class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 hover:bg-amber-500 hover:text-white transition-colors duration-300">
                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-16 text-center">
            <a href="{{ route('services') }}" class="inline-flex items-center px-8 py-3 bg-slate-900 text-white rounded-full font-semibold hover:bg-slate-800 transition-all">
                View All Services
            </a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-slate-950">
        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Impact" class="w-full h-full object-cover opacity-20">
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-8">Ready to Make an Impact?</h2>
        <p class="text-slate-300 text-xl mb-12">Your contribution helps us provide education, healthcare, and essential relief to those in need. Join us in building a better future.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="{{ route('contact') }}" class="px-10 py-4 gold-gradient text-white rounded-full font-bold text-lg shadow-xl hover:scale-105 transition-all">Get Involved</a>
            <a href="{{ route('contact') }}" class="px-10 py-4 bg-white/10 backdrop-blur-md text-white border border-white/20 rounded-full font-bold text-lg hover:bg-white/20 transition-all">Volunteer With Us</a>
        </div>
    </div>
</section>
@endsection
