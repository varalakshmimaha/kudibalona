@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<!-- Page Header -->
<div class="bg-white py-20 text-center relative">
    <h1 class="text-4xl md:text-6xl font-bold text-slate-800 mb-8 font-serif">Contact Us</h1>
    <div class="inline-flex items-center px-6 py-2 bg-amber-600 text-white text-xs font-bold uppercase tracking-widest rounded-r-full absolute left-0 bottom-10">
        <a href="{{ route('home') }}" class="hover:text-amber-200">HOME</a>
        <span class="mx-2">/</span>
        <span>CONTACT US</span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
        <!-- Left Side: Message & Socials -->
        <div class="space-y-8">
            <div class="relative pl-6">
                <i data-lucide="heart" class="w-6 h-6 text-amber-500 fill-current absolute top-0 left-0 -translate-y-2 opacity-30"></i>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-2">Get in Touch With Us</h2>
                <p class="text-amber-600 font-bold tracking-widest uppercase text-xs">WRITE A MESSAGE</p>
            </div>
            
            <p class="text-slate-600 leading-relaxed text-lg">
                We'd love to hear from you! Whether you have questions, want to volunteer, or wish to support our initiatives, reach out to Koodibhalona Trust. Our team is always ready to assist and guide you in contributing to meaningful change.
            </p>

            <!-- Social Media Icons -->
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="#" class="w-10 h-10 rounded-md bg-[#48C0C1] text-white flex items-center justify-center hover:scale-110 transition-transform">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-md bg-[#EE7254] text-white flex items-center justify-center hover:scale-110 transition-transform">
                    <i data-lucide="facebook" class="w-5 h-5"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-md bg-[#FBC02D] text-white flex items-center justify-center hover:scale-110 transition-transform">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-md bg-[#A855F7] text-white flex items-center justify-center hover:scale-110 transition-transform">
                    <i data-lucide="youtube" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

        <!-- Right Side: Contact Form -->
        <div class="space-y-6">
            @if(session('success'))
                <div class="p-4 bg-green-50 text-green-700 rounded-xl border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="col-span-1">
                    <input type="text" name="name" placeholder="Your Name *" required class="w-full px-5 py-4 bg-gray-100 border-none rounded-md focus:ring-2 focus:ring-amber-500 outline-none placeholder:text-gray-400 text-sm">
                </div>
                <div class="col-span-1">
                    <input type="email" name="email" placeholder="Your Email *" required class="w-full px-5 py-4 bg-gray-100 border-none rounded-md focus:ring-2 focus:ring-amber-500 outline-none placeholder:text-gray-400 text-sm">
                </div>
                <div class="col-span-2">
                    <input type="text" name="subject" placeholder="Your Subject" required class="w-full px-5 py-4 bg-gray-100 border-none rounded-md focus:ring-2 focus:ring-amber-500 outline-none placeholder:text-gray-400 text-sm">
                </div>
                <div class="col-span-2">
                    <textarea name="message" rows="5" placeholder="Your message" required class="w-full px-5 py-4 bg-gray-100 border-none rounded-md focus:ring-2 focus:ring-amber-500 outline-none placeholder:text-gray-400 text-sm"></textarea>
                </div>
                <div class="col-span-2 pt-2">
                    <button type="submit" class="bg-[#F59E0B] hover:bg-amber-600 text-white font-bold py-4 px-10 rounded-md shadow-lg transition-all uppercase tracking-widest text-xs">
                        SEND
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 mt-32 rounded-3xl overflow-hidden shadow-2xl">
        <!-- About Card -->
        <div class="bg-[#48C0C1] p-12 text-white space-y-4 min-h-[300px] flex flex-col justify-center">
            <h3 class="text-2xl font-bold">About</h3>
            <p class="text-white/90 leading-relaxed font-medium">
                Serving communities through education, health, welfare, and social development.
            </p>
        </div>

        <!-- Address Card -->
        <div class="bg-[#EE7254] p-12 text-white space-y-4 min-h-[300px] flex flex-col justify-center">
            <h3 class="text-2xl font-bold">Address</h3>
            <p class="text-white/90 leading-relaxed font-medium capitalize">
                {{ $info->address }}
            </p>
        </div>

        <!-- Contact Card -->
        <div class="bg-[#FBC02D] p-12 text-white space-y-4 min-h-[300px] flex flex-col justify-center">
            <h3 class="text-2xl font-bold">Contact</h3>
            <div class="text-white/90 space-y-2 font-medium">
                <p>{{ $info->email }}</p>
                <p>{{ $info->phone }} / {{ $info->phone2 }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Banner Image -->
<div class="w-full h-[300px] md:h-[450px]">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Banner" class="w-full h-full object-cover">
</div>

@endsection
