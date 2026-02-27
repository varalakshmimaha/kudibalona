@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
        </div>
        <h4 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Messages</h4>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['messages'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
        </div>
        <h4 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Services</h4>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['services'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                <i data-lucide="image" class="w-6 h-6"></i>
            </div>
        </div>
        <h4 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Slides</h4>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['slides'] }}</p>
    </div>
</div>

<!-- Recent Activity/Info -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-bold">Welcome to your management panel</h3>
    </div>
    <div class="p-6 prose prose-amber max-w-none">
        <p>From here, you can manage the content of the Koodibhalona Trust website. Use the sidebar to navigate between different sections.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                <h4 class="font-bold flex items-center mb-4"><i data-lucide="shield-check" class="w-5 h-5 mr-2 text-amber-500"></i> Services</h4>
                <p class="text-sm text-slate-600 mb-4">Manage the NGO services listed on your website. Add descriptions, tags, and sub-links.</p>
                <a href="{{ route('admin.services.index') }}" class="text-amber-600 text-sm font-bold hover:underline">Manage Services &rarr;</a>
            </div>
            <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                <h4 class="font-bold flex items-center mb-4"><i data-lucide="mail" class="w-5 h-5 mr-2 text-amber-500"></i> Messages</h4>
                <p class="text-sm text-slate-600 mb-4">View and respond to inquiries sent through the contact form.</p>
                <a href="{{ route('admin.messages') }}" class="text-amber-600 text-sm font-bold hover:underline">View Messages &rarr;</a>
            </div>
            <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                <h4 class="font-bold flex items-center mb-4"><i data-lucide="settings" class="w-5 h-5 mr-2 text-amber-500"></i> Settings</h4>
                <p class="text-sm text-slate-600 mb-4">Update general site information like name, tagline, and footer text.</p>
                <a href="{{ route('admin.settings') }}" class="text-amber-600 text-sm font-bold hover:underline">Update Settings &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection

