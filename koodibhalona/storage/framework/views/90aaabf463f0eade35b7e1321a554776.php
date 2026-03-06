

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $objective  = \App\Models\Objective::first();
    $focusItems = collect($objective?->list_items ?? [])
                      ->map(fn($i) => trim((string)$i))
                      ->filter()->values()->all();
    $aboutContentImage = \App\Models\SiteSetting::get('home_page_image')
        ?: \App\Models\SiteSetting::get('about_page_image')
        ?: \App\Models\SiteSetting::get('about_banner_image');

    // YouTube thumbnail
    $ytUrl = $objective?->youtube_url;
    $ytWatchUrl = $ytThumbUrl = null;
    if ($ytUrl) {
        $p = parse_url(trim($ytUrl));
        parse_str($p['query'] ?? '', $q);
        $host = strtolower($p['host'] ?? '');
        $path = trim($p['path'] ?? '', '/');
        if (!empty($q['v']))                              { $vid = $q['v']; }
        elseif (str_contains($host,'youtu.be'))          { $vid = explode('/',$path)[0] ?? null; }
        elseif (preg_match('~^(shorts|live|embed)/(\S+)~',$path,$m)) { $vid = $m[2]; }
        else                                             { $vid = null; }
        if ($vid) { $ytWatchUrl = 'https://www.youtube.com/watch?v='.$vid; $ytThumbUrl = 'https://img.youtube.com/vi/'.$vid.'/hqdefault.jpg'; }
        elseif (!empty($q['list'])) { $ytWatchUrl = 'https://www.youtube.com/playlist?list='.$q['list']; }
    }
?>




<section class="relative overflow-hidden" style="min-height:calc(100vh - 80px);" id="hero-slider">

    
    <div class="hero-slides-wrapper" id="hero-slides-wrapper">
    <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $bg = !empty(trim((string)$slide->image))
            ? asset('storage/' . $slide->image)
            : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
    ?>
    <div class="hero-slide <?php echo e($i === 0 ? 'active' : ''); ?>" data-index="<?php echo e($i); ?>">
        
        <div class="hero-bg" style="background-image:url('<?php echo e($bg); ?>');"></div>

        
        <div class="hero-overlay"></div>

        
        <div class="hero-content">
            <?php if($slide->label): ?>
            <p class="hero-label"><?php echo e($slide->label); ?></p>
            <?php endif; ?>
            <h1 class="hero-title">
                <?php echo e($slide->title); ?>

                <?php if($slide->subtitle): ?>
                    <span class="hero-subtitle-inline"><?php echo e($slide->subtitle); ?></span>
                <?php endif; ?>
            </h1>
            <?php if($slide->button_text && $slide->button_link): ?>
            <a href="<?php echo e($slide->button_link); ?>" class="hero-btn">
                <?php echo e($slide->button_text); ?>

                <svg xmlns="http://www.w3.org/2000/svg" class="hero-btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if(count($slides) > 1): ?>
    <button class="hero-arrow hero-arrow-prev" id="hero-prev" aria-label="Previous slide">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="hero-arrow hero-arrow-next" id="hero-next" aria-label="Next slide">
        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>

    
    <div class="hero-dots" id="hero-dots">
        <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button class="hero-dot <?php echo e($i === 0 ? 'active' : ''); ?>" data-index="<?php echo e($i); ?>" aria-label="Slide <?php echo e($i+1); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</section>




<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
            <div class="relative">
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="<?php echo e($aboutContentImage ? asset('storage/' . $aboutContentImage) : 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80'); ?>" alt="Our Work" class="w-full h-auto">
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
                    <a href="<?php echo e(route('about')); ?>" class="inline-flex items-center text-amber-600 font-semibold hover:text-amber-700 transition-colors">
                        Discover more about us <i data-lucide="arrow-right" class="ml-2 w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="py-24 bg-[#fbfbfd] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="text-center mb-14">
            <h3 class="text-amber-600 font-bold tracking-wider uppercase text-sm mb-3">What We Stand For</h3>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 font-serif">Objectives of Koodibhalona Trust</h2>
            <p class="text-slate-600 text-lg mt-4 max-w-2xl mx-auto">The Trust is established for public charitable purposes and shall function to serve society without discrimination of caste, creed, gender, or religion.</p>
        </div>
        <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-start">
            <div class="space-y-8">
                <?php if(!empty(trim((string)$objective?->image))): ?>
                    <div class="rounded-[20px] overflow-hidden shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#efefef] bg-white">
                        <img src="<?php echo e(asset('storage/'.$objective->image)); ?>" alt="Objectives" class="w-full h-auto object-cover">
                    </div>
                <?php else: ?>
                    <div class="rounded-[20px] overflow-hidden shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#efefef] bg-white">
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Impact" class="w-full h-auto object-cover">
                    </div>
                <?php endif; ?>
                <?php if($ytWatchUrl): ?>
                <a href="<?php echo e($ytWatchUrl); ?>" target="_blank" rel="noopener"
                   class="group relative block rounded-[20px] overflow-hidden shadow-[0_10px_30px_rgba(15,23,42,0.10)] border border-[#efefef] bg-black">
                    <?php if($ytThumbUrl): ?>
                        <img src="<?php echo e($ytThumbUrl); ?>" alt="Watch on YouTube" class="w-full h-auto object-cover opacity-80 group-hover:opacity-60 transition-opacity duration-300">
                    <?php else: ?>
                        <div class="w-full aspect-video bg-slate-800 flex items-center justify-center"><span class="text-white/60 text-sm">Watch Playlist</span></div>
                    <?php endif; ?>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 p-4">
                        <p class="text-white text-sm font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M23.5 6.2a3 3 0 00-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 00.5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 002.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 002.1-2.1c.5-1.9.5-5.8.5-5.8s0-3.9-.5-5.8z"/><polygon fill="white" points="9.6,15.6 15.8,12 9.6,8.4"/></svg>
                            Watch on YouTube
                        </p>
                    </div>
                </a>
                <?php endif; ?>
            </div>
            <div class="mt-12 lg:mt-0">
                <div class="bg-white rounded-[22px] shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#eaeaea] p-6 sm:p-8 lg:p-10">
                    <h3 class="text-2xl font-bold font-serif text-slate-900 mb-4 border-b border-gray-100 pb-3">Our Key Focus Areas</h3>
                    <?php if(count($focusItems) > 0): ?>
                        <div class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $focusItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-start gap-3 py-3 group">
                                <span class="text-amber-500 font-bold text-lg leading-tight mt-0.5 flex-shrink-0">›</span>
                                <p class="text-slate-700 font-medium leading-relaxed group-hover:text-slate-900 transition-colors"><?php echo e($item); ?></p>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center py-12 text-slate-400">
                            <i data-lucide="list" class="w-10 h-10 mb-3 opacity-40"></i>
                            <p class="text-sm text-center">No objectives added yet.<br>
                                <a href="/admin/objectives" class="text-amber-600 hover:underline">Add them from the Admin panel →</a>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h3 class="text-amber-600 font-bold tracking-wider uppercase text-sm mb-3">What We Do</h3>
            <h2 class="text-4xl font-bold text-slate-900">Our Core Initiatives</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col items-center group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-amber-50/50 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                <div class="relative w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center mb-6 shadow-sm p-1">
                    <img src="<?php echo e(!empty(trim((string)$service->image)) ? (Str::startsWith($service->image,'http') ? $service->image : asset('storage/'.$service->image)) : asset('favicon.ico')); ?>" class="w-full h-full object-cover rounded-xl" alt="icon">
                </div>
                <h4 class="text-xl font-bold text-slate-900 mb-3 text-center font-serif relative z-10"><?php echo e($service->title); ?></h4>
                <p class="text-slate-600 text-sm line-clamp-3 mb-6 text-center leading-relaxed relative z-10"><?php echo e($service->description); ?></p>
                <div class="mt-auto w-full pt-4 border-t border-slate-100 flex items-center justify-between relative z-10">
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase tracking-wider"><?php echo e(explode(' · ',$service->tag)[0]); ?></span>
                    <a href="<?php echo e(route('services')); ?>" class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 hover:bg-amber-500 hover:text-white transition-colors duration-300">
                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-16 text-center">
            <a href="<?php echo e(route('services')); ?>" class="inline-flex items-center px-8 py-3 bg-slate-900 text-white rounded-full font-semibold hover:bg-slate-800 transition-all">
                View All Services
            </a>
        </div>
    </div>
</section>




<section class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-slate-950">
        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Impact" class="w-full h-full object-cover opacity-20">
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-8">Ready to Make an Impact?</h2>
        <p class="text-slate-300 text-xl mb-12">Your contribution helps us provide education, healthcare, and essential relief to those in need. Join us in building a better future.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="<?php echo e(route('contact')); ?>" class="px-10 py-4 gold-gradient text-white rounded-full font-bold text-lg shadow-xl hover:scale-105 transition-all">Get Involved</a>
            <a href="<?php echo e(route('contact')); ?>" class="px-10 py-4 bg-white/10 backdrop-blur-md text-white border border-white/20 rounded-full font-bold text-lg hover:bg-white/20 transition-all">Volunteer With Us</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
/* ── Hero Slider ─────────────────────────────── */
#hero-slider {
    position: relative;
    width: 100%;
    min-height: calc(100vh - 80px);
    overflow: hidden;
    background: #1e0a3c;
}
.hero-slides-wrapper {
    position: relative;
    width: 100%;
    min-height: calc(100vh - 80px);
}
/* pseudo-element keeps wrapper height even when all children are absolute */
.hero-slides-wrapper::before {
    content: '';
    display: block;
    min-height: calc(100vh - 80px);
}
.hero-slide {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    opacity: 0;
    transition: opacity 0.9s cubic-bezier(.4,0,.2,1);
    pointer-events: none;
    z-index: 1;
}
.hero-slide.active {
    opacity: 1;
    pointer-events: auto;
    z-index: 2;
}
/* Background image */
.hero-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transform: scale(1.04);
    transition: transform 6s ease;
}
.hero-slide.active .hero-bg {
    transform: scale(1);
}
/* Purple → orange gradient overlay (matching screenshot) */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(88, 28, 135, 0.82) 0%,
        rgba(124, 58, 237, 0.70) 35%,
        rgba(217, 119, 6, 0.55) 65%,
        rgba(180, 83, 9, 0.75) 100%
    );
}
/* Content */
.hero-content {
    position: relative;
    z-index: 10;
    max-width: 80rem;
    margin: 0 auto;
    padding: 0 1.5rem;
    width: 100%;
    padding-top: 2rem;
    padding-bottom: 5rem;
}
.hero-label {
    font-size: 0.875rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(253, 230, 138, 0.95);
    margin-bottom: 1rem;
    animation: slideUp 0.7s ease both;
    animation-delay: 0.1s;
}
.hero-title {
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    max-width: 55rem;
    margin-bottom: 2rem;
    font-family: 'Playfair Display', serif;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
    animation: slideUp 0.7s ease both;
    animation-delay: 0.2s;
}
.hero-subtitle-inline {
    display: block;
    color: #fde68a;
    font-size: 0.85em;
    margin-top: 0.3em;
}
.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: linear-gradient(135deg, #B8860B 0%, #FFD700 50%, #DAA520 100%);
    color: #1a1a1a;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 9999px;
    text-decoration: none;
    box-shadow: 0 8px 30px rgba(218,165,32,0.45);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    animation: slideUp 0.7s ease both;
    animation-delay: 0.35s;
}
.hero-btn:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 14px 40px rgba(218,165,32,0.55);
}
.hero-btn-icon { width: 18px; height: 18px; transition: transform 0.2s; }
.hero-btn:hover .hero-btn-icon { transform: translateX(4px); }

/* Arrows */
.hero-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(255,255,255,0.18);
    border: 1.5px solid rgba(255,255,255,0.35);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    backdrop-filter: blur(8px);
}
.hero-arrow svg { width: 22px; height: 22px; }
.hero-arrow:hover { background: rgba(255,255,255,0.30); transform: translateY(-50%) scale(1.08); }
.hero-arrow-prev { left: 1.25rem; }
.hero-arrow-next { right: 1.25rem; }

/* Dots */
.hero-dots {
    position: absolute;
    bottom: 1.75rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 20;
    display: flex;
    gap: 10px;
}
.hero-dot {
    width: 10px;
    height: 10px;
    border-radius: 9999px;
    background: rgba(255,255,255,0.40);
    border: none;
    cursor: pointer;
    transition: background 0.3s, width 0.3s;
}
.hero-dot.active {
    background: #FFD700;
    width: 28px;
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 640px) {
    .hero-title { font-size: 1.75rem; }
    .hero-btn   { padding: 12px 24px; font-size: 0.9rem; }
    .hero-arrow { width: 38px; height: 38px; }
    .hero-arrow svg { width: 18px; height: 18px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
(function() {
    var slides     = document.querySelectorAll('.hero-slide');
    var dots       = document.querySelectorAll('.hero-dot');
    var prevBtn    = document.getElementById('hero-prev');
    var nextBtn    = document.getElementById('hero-next');
    var total      = slides.length;
    var current    = 0;
    var timer      = null;
    var INTERVAL   = 5000;

    if (total <= 1) return;

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current] && dots[current].classList.remove('active');
        current = (index + total) % total;
        slides[current].classList.add('active');
        dots[current] && dots[current].classList.add('active');
    }

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(function() { goTo(current + 1); }, INTERVAL);
    }

    if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); startAuto(); });

    dots.forEach(function(dot, i) {
        dot.addEventListener('click', function() { goTo(i); startAuto(); });
    });

    // Touch / swipe support
    var touchStartX = 0;
    var sliderEl = document.getElementById('hero-slider');
    sliderEl.addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
    sliderEl.addEventListener('touchend', function(e) {
        var diff = touchStartX - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); startAuto(); }
    }, { passive: true });

    startAuto();
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\varalakshmi\Desktop\charity\koodibhalona\resources\views/home.blade.php ENDPATH**/ ?>