<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | {{ \App\Models\SiteSetting::get('site_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@lucide/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
    @yield('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white flex flex-col fixed inset-y-0">
            <div class="p-6 border-b border-slate-800">
                <h1 class="text-xl font-bold uppercase tracking-tight text-amber-500">Admin Panel</h1>
            </div>
            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i> Dashboard
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="shield-check" class="w-5 h-5 mr-3"></i> Services
                </a>
                <a href="{{ route('admin.objectives') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.objectives') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="target" class="w-5 h-5 mr-3"></i> Objectives
                </a>
                <a href="{{ route('admin.banners') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.banners') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="layout-panel-top" class="w-5 h-5 mr-3"></i> Banners
                </a>
                <a href="{{ route('admin.about') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.about') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="info" class="w-5 h-5 mr-3"></i> About Us
                </a>
                <a href="{{ route('admin.translations.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.translations.*') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="languages" class="w-5 h-5 mr-3"></i> Translations
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="image" class="w-5 h-5 mr-3"></i> Gallery
                </a>
                <a href="{{ route('admin.teams.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.teams.*') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="users" class="w-5 h-5 mr-3"></i> Teams
                </a>
                <a href="{{ route('admin.messages') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.messages') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="mail" class="w-5 h-5 mr-3"></i> Messages
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.settings') ? 'bg-amber-500 text-white' : '' }}">
                    <i data-lucide="settings" class="w-5 h-5 mr-3"></i> Settings
                </a>
                <div class="pt-4 border-t border-slate-800 mt-4 space-y-2">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-900/30 transition-colors text-red-400">
                            <i data-lucide="log-out" class="w-5 h-5 mr-3"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-grow ml-64">
            <header class="bg-white shadow-sm h-20 flex items-center justify-between px-8 sticky top-0 z-10">
                <h2 class="text-2xl font-bold text-gray-800">@yield('header', 'Overview')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Admin User</span>
                    <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <main class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl flex items-center">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script>lucide.createIcons();</script>
    @yield('scripts')
</body>
</html>
