@extends('layouts.app')

@section('title', 'NGO Services')

@section('content')
<!-- Page Header with Background Image -->
<div class="relative py-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="NGO Services Banner" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif">NGO Services</h1>
        <nav class="flex justify-center items-center gap-3 text-sm font-bold tracking-widest uppercase text-white/80">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">HOME</a>
            <span class="text-white/40">/</span>
            <span class="text-amber-500">NGO SERVICES</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="space-y-32">
        @foreach($services as $service)
        <div class="flex flex-col md:flex-row gap-12 items-start group">
            <!-- Left Side: Image -->
            <div class="w-full md:w-[400px] shrink-0">
                <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-100 aspect-[4/3]">
                    <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" 
                        alt="{{ $service->title }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="flex-grow space-y-4">
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 group-hover:text-amber-600 transition-colors">
                    {{ $service->title }}
                </h2>
                <p class="text-amber-600 font-bold tracking-widest uppercase text-xs">
                    {{ $service->tag }}
                </p>
                <div class="text-slate-600 leading-relaxed text-sm md:text-base border-t border-slate-100 pt-6">
                    {{ $service->description }}
                </div>
                
                @if($service->sub_links && count($service->sub_links) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 pt-4">
                    @foreach($service->sub_links as $link)
                    <div class="flex items-center text-slate-500 text-sm">
                        <i data-lucide="check" class="w-4 h-4 mr-2 text-amber-500"></i>
                        {{ $link }}
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Bottom Contact CTA -->
<section class="bg-slate-900 py-20">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-white mb-8">Need more information about our programs?</h2>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-10 py-4 gold-gradient text-white rounded-full font-bold shadow-2xl hover:scale-105 transition-all">
            Get In Touch
            <i data-lucide="message-circle" class="ml-2 w-5 h-5"></i>
        </a>
    </div>
</section>
@endsection
