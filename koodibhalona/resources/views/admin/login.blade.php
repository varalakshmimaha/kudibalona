<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | {{ \App\Models\SiteSetting::get('site_name', 'Koodibhalona Trust') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lucide/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .gold-gradient { background: linear-gradient(135deg, #B8860B 0%, #FFD700 50%, #DAA520 100%); }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center relative overflow-hidden">
    <!-- Grid Overlay -->
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(#DAA520 1px, transparent 1px); background-size: 40px 40px;"></div>
    <!-- Glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[400px] bg-amber-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-600/5 rounded-full blur-[80px]"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-block">
                <h1 class="text-4xl font-bold tracking-tighter text-white uppercase font-serif">
                    <span class="text-amber-500">KOODI</span>BHALONA
                </h1>
                <p class="text-[10px] tracking-[0.4em] text-amber-500/60 font-bold uppercase mt-1">Admin Panel</p>
            </a>
        </div>

        <!-- Card -->
        <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 shadow-2xl">
            <!-- Technical Corner Accents -->
            <div class="absolute -top-px -left-px w-8 h-8 border-t-2 border-l-2 border-amber-500/30 rounded-tl-3xl"></div>
            <div class="absolute -bottom-px -right-px w-8 h-8 border-b-2 border-r-2 border-amber-500/30 rounded-br-3xl"></div>

            <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-slate-400 text-sm mb-8">Sign in to manage your website content.</p>

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-sm flex items-center">
                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2 shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->has('credentials'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl text-sm flex items-center">
                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2 shrink-0"></i>
                    {{ $errors->first('credentials') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-slate-500"></i>
                        </div>
                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            required
                            autofocus
                            placeholder="admin"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl pl-11 pr-4 py-3 text-white text-sm placeholder:text-slate-600 focus:outline-none focus:border-amber-500/50 focus:bg-slate-800 transition-all"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-500"></i>
                        </div>
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            id="password-input"
                            class="w-full bg-slate-800/50 border border-slate-700 rounded-xl pl-11 pr-12 py-3 text-white text-sm placeholder:text-slate-600 focus:outline-none focus:border-amber-500/50 focus:bg-slate-800 transition-all"
                        >
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-4 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                            <i data-lucide="eye" class="w-4 h-4" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 gold-gradient text-white font-bold rounded-xl text-sm tracking-wide hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg shadow-amber-500/20 flex items-center justify-center">
                    <i data-lucide="log-in" class="w-4 h-4 mr-2"></i>
                    Sign In to Admin
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-800 flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-amber-500 transition-colors flex items-center">
                    <i data-lucide="arrow-left" class="w-3 h-3 mr-1"></i> Back to Website
                </a>
                <div class="flex items-center text-[10px] text-slate-600 font-mono">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                    SECURE CONNECTION
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        const toggleBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password-input');
        const eyeIcon = document.getElementById('eye-icon');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        });
    </script>
</body>
</html>
