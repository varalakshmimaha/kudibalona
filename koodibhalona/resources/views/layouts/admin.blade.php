<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | {{ \App\Models\SiteSetting::get('site_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@lucide/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-sidebar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            transform: translateX(4px);
        }
        .nav-item.active {
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            font-weight: 600;
        }
        .nav-item.active i {
            color: white;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased notranslate">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 glass-sidebar text-slate-300 flex flex-col fixed inset-y-0 left-0 z-50 transition-transform duration-300">
            <div class="h-20 flex items-center justify-center border-b border-slate-700/50 px-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 w-full">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <i data-lucide="shield" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <span class="text-lg font-bold text-white tracking-wide truncate">KOODI<span class="text-amber-500">ADMIN</span></span>
                        <span class="text-[10px] text-slate-400 uppercase tracking-widest truncate">Management Panel</span>
                    </div>
                </a>
            </div>
            
            <div class="flex-1 overflow-y-auto py-6 px-4 scrollbar-thin scrollbar-thumb-slate-700">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-3">Main</div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}"></i> 
                        Overview
                    </a>
                </nav>

                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-3">Content</div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('admin.services.index') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i data-lucide="briefcase" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-slate-400' }}"></i> Services
                    </a>
                    <a href="{{ route('admin.objectives') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.objectives') ? 'active' : '' }}">
                        <i data-lucide="target" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.objectives') ? 'text-white' : 'text-slate-400' }}"></i> Objectives
                    </a>
                    <a href="{{ route('admin.banners') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.banners') ? 'active' : '' }}">
                        <i data-lucide="image" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.banners') ? 'text-white' : 'text-slate-400' }}"></i> Hero Banners
                    </a>
                    <a href="{{ route('admin.about') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                        <i data-lucide="users" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.about') ? 'text-white' : 'text-slate-400' }}"></i> About Us
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                        <i data-lucide="images" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.gallery.*') ? 'text-white' : 'text-slate-400' }}"></i> Gallery
                    </a>
                    <a href="{{ route('admin.teams.index') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                        <i data-lucide="users-round" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.teams.*') ? 'text-white' : 'text-slate-400' }}"></i> Teams
                    </a>
                </nav>

                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-3">System</div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('admin.messages') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.messages') ? 'active relative' : 'relative' }}">
                        <i data-lucide="mail" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.messages') ? 'text-white' : 'text-slate-400' }}"></i> Messages
                    </a>
                    <a href="{{ route('admin.translations.index') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.translations.*') ? 'active' : '' }}">
                        <i data-lucide="languages" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.translations.*') ? 'text-white' : 'text-slate-400' }}"></i> Translations
                    </a>
                    <a href="{{ route('admin.settings') }}" class="nav-item flex items-center px-3 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i data-lucide="settings" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings') ? 'text-white' : 'text-slate-400' }}"></i> Settings
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-slate-700/50 mt-auto">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-slate-800/50 hover:bg-red-500/10 hover:text-red-400 hover:border-red-500/20 text-slate-300 rounded-xl transition-all border border-transparent text-sm font-medium">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col ml-64 min-w-0 bg-slate-50">
            <!-- Top Header -->
            <header class="h-20 bg-white/80 backdrop-blur-lg border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-40">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">@yield('header', 'Overview')</h2>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" target="_blank" class="hidden md:flex items-center text-sm font-medium text-slate-500 hover:text-amber-600 transition-colors bg-slate-100 px-4 py-2 rounded-full">
                        <i data-lucide="external-link" class="w-4 h-4 mr-2"></i> View Website
                    </a>
                    
                    <div class="h-8 w-px bg-slate-200 hidden md:block"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col items-end hidden sm:flex">
                            <span class="text-sm font-bold text-slate-700 leading-none">Super Admin</span>
                            <span class="text-xs text-slate-500">System Manager</span>
                        </div>
                        <div class="w-11 h-11 rounded-full bg-slate-900 border-2 border-amber-500/30 flex items-center justify-center text-white font-bold shadow-md shadow-amber-500/10 relative">
                            A
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8">
                <div class="max-w-7xl mx-auto">
                    <!-- Global Notifications -->
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-start shadow-sm animate-fade-in-up">
                            <div class="p-2 bg-emerald-100 rounded-xl text-emerald-600 mr-4 shrink-0">
                                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-emerald-800 font-bold text-sm">Success</h4>
                                <p class="text-emerald-600 text-sm mt-0.5">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start shadow-sm animate-fade-in-up">
                            <div class="p-2 bg-red-100 rounded-xl text-red-600 mr-4 shrink-0">
                                <i data-lucide="alert-octagon" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-red-800 font-bold text-sm">Error</h4>
                                <p class="text-red-600 text-sm mt-0.5">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // Add subtle animation to alerts
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { animation: fadeInUp 0.4s ease-out forwards; }
        `;
        document.head.appendChild(style);
    </script>
    @yield('scripts')
</body>
</html>
