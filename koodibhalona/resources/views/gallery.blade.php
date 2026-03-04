@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<!-- Header -->
<div class="relative py-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Gallery" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 uppercase tracking-tight font-serif">Impact Gallery</h1>
        <p class="text-xl text-slate-300 max-w-3xl mx-auto">
            Visual stories of change, compassion, and the lives we've touched together.
        </p>
    </div>
</div>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($items->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
            <i data-lucide="image" class="w-16 h-16 mx-auto text-slate-300 mb-6"></i>
            <h2 class="text-2xl font-bold text-slate-600 dark:text-slate-400">Our gallery is coming soon</h2>
            <p class="text-slate-500 max-w-md mx-auto mt-4">We are busy documenting our latest impact stories. Please check back later.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($items as $item)
            <div class="group relative rounded-3xl overflow-hidden shadow-lg aspect-square">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-8">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $item->caption }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Impact" class="w-full h-full object-cover">
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Want to see more of our work?</h2>
        <p class="text-slate-300 text-xl mb-12">Follow us on social media for daily updates from the field and real-time impact stories.</p>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="#" class="notranslate inline-flex items-center px-8 py-3 bg-white text-slate-900 rounded-full font-bold hover:bg-slate-100 transition-all font-serif" translate="no">
                <i data-lucide="instagram" class="mr-2 w-5 h-5 text-pink-600"></i> Instagram
            </a>
            <a href="#" class="notranslate inline-flex items-center px-8 py-3 bg-white text-slate-900 rounded-full font-bold hover:bg-slate-100 transition-all font-serif" translate="no">
                <i data-lucide="facebook" class="mr-2 w-5 h-5 text-blue-600"></i> Facebook
            </a>
        </div>
    </div>
</section>
@endsection
