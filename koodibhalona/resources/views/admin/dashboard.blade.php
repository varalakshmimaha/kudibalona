@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<!-- Welcome Header -->
<div class="mb-10 w-full rounded-3xl bg-slate-900 overflow-hidden relative shadow-xl">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-slate-800"></div>
    <!-- Decorative elements -->
    <div class="absolute right-0 top-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute right-[20%] bottom-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2"></div>
    <div class="absolute left-0 top-0 w-full h-full opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
    
    <div class="relative z-10 p-8 sm:p-12 flex flex-col sm:flex-row items-center justify-between gap-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Welcome back to the Dashboard! 👋</h2>
            <p class="text-slate-400 max-w-xl">You have complete control over the content of the Koodibhalona Trust website. Use the quick links below or the sidebar to navigate to different sections.</p>
        </div>
        <div class="hidden md:flex shrink-0 w-32 h-32 bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl flex items-center justify-center -rotate-6 shadow-2xl">
            <i data-lucide="layout-dashboard" class="w-16 h-16 text-amber-500 opacity-80"></i>
        </div>
    </div>
</div>

<!-- Stats -->
<h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2"><i data-lucide="bar-chart-3" class="w-5 h-5 text-amber-500"></i> Platform Statistics</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
    <!-- Stat Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-6">
            <div class="p-3 bg-indigo-50 text-indigo-500 rounded-xl group-hover:scale-110 group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300 shadow-sm">
                <i data-lucide="mail-open" class="w-6 h-6"></i>
            </div>
            <span class="flex items-center text-xs font-semibold text-emerald-500 bg-emerald-50 px-2.5 py-1 rounded-full"><i data-lucide="trending-up" class="w-3 h-3 mr-1"></i> Live</span>
        </div>
        <h4 class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Messages Received</h4>
        <p class="text-4xl font-extrabold text-slate-800">{{ $stats['messages'] }}</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-6">
            <div class="p-3 bg-amber-50 text-amber-500 rounded-xl group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                <i data-lucide="briefcase" class="w-6 h-6"></i>
            </div>
            <span class="flex items-center text-xs font-semibold text-emerald-500 bg-emerald-50 px-2.5 py-1 rounded-full"><i data-lucide="check" class="w-3 h-3 mr-1"></i> Active</span>
        </div>
        <h4 class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Total Services</h4>
        <p class="text-4xl font-extrabold text-slate-800">{{ $stats['services'] }}</p>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-amber-200 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-6">
            <div class="p-3 bg-sky-50 text-sky-500 rounded-xl group-hover:scale-110 group-hover:bg-sky-500 group-hover:text-white transition-all duration-300 shadow-sm">
                <i data-lucide="slideshow" class="w-6 h-6"></i>
            </div>
            <span class="flex items-center text-xs font-semibold text-emerald-500 bg-emerald-50 px-2.5 py-1 rounded-full"><i data-lucide="monitor" class="w-3 h-3 mr-1"></i> Public</span>
        </div>
        <h4 class="text-slate-500 text-sm font-semibold uppercase tracking-wider mb-1">Hero Slides</h4>
        <p class="text-4xl font-extrabold text-slate-800">{{ $stats['slides'] }}</p>
    </div>
</div>

<!-- Quick Links -->
<h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2"><i data-lucide="zap" class="w-5 h-5 text-amber-500"></i> Quick Actions</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Action 1 -->
    <a href="{{ route('admin.services.index') }}" class="block p-6 bg-white rounded-2xl border border-slate-100 hover:border-amber-500 hover:shadow-lg transition-all duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 bg-slate-50 w-32 h-32 rounded-full z-0 group-hover:bg-amber-50 transition-colors duration-500"></div>
        <div class="relative z-10 flex flex-col h-full">
            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-600 mb-5 group-hover:bg-amber-100 group-hover:text-amber-600 transition-colors">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <h4 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-amber-600 transition-colors">Manage Services</h4>
            <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">Add, edit, or remove the NGO services and their descriptions listed on your website.</p>
            <div class="mt-auto flex items-center text-sm font-bold text-slate-800 group-hover:text-amber-600">
                Go to Services <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </div>
    </a>

    <!-- Action 2 -->
    <a href="{{ route('admin.messages') }}" class="block p-6 bg-white rounded-2xl border border-slate-100 hover:border-amber-500 hover:shadow-lg transition-all duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 bg-slate-50 w-32 h-32 rounded-full z-0 group-hover:bg-amber-50 transition-colors duration-500"></div>
        <div class="relative z-10 flex flex-col h-full">
            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-600 mb-5 group-hover:bg-amber-100 group-hover:text-amber-600 transition-colors">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </div>
            <h4 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-amber-600 transition-colors">Check Messages</h4>
            <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">Read and respond to the latest inquiries sent by users through the contact form.</p>
            <div class="mt-auto flex items-center text-sm font-bold text-slate-800 group-hover:text-amber-600">
                Inbox folder <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </div>
    </a>

    <!-- Action 3 -->
    <a href="{{ route('admin.settings') }}" class="block p-6 bg-white rounded-2xl border border-slate-100 hover:border-amber-500 hover:shadow-lg transition-all duration-300 group relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 bg-slate-50 w-32 h-32 rounded-full z-0 group-hover:bg-amber-50 transition-colors duration-500"></div>
        <div class="relative z-10 flex flex-col h-full">
            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-600 mb-5 group-hover:bg-amber-100 group-hover:text-amber-600 transition-colors">
                <i data-lucide="sliders-horizontal" class="w-6 h-6"></i>
            </div>
            <h4 class="font-bold text-lg text-slate-800 mb-2 group-hover:text-amber-600 transition-colors">Site Settings</h4>
            <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">Update essential site information including logos, contact details, and footer text.</p>
            <div class="mt-auto flex items-center text-sm font-bold text-slate-800 group-hover:text-amber-600">
                Update Config <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform"></i>
            </div>
        </div>
    </a>
</div>
@endsection

