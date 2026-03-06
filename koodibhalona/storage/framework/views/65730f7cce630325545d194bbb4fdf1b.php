

<?php $__env->startSection('title', 'About Us'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $innerPageBanner = \App\Models\SiteSetting::get('about_page_banner')
        ?: \App\Models\SiteSetting::get('banner_2_image');
    $aboutContentImage = \App\Models\SiteSetting::get('about_page_image')
        ?: \App\Models\SiteSetting::get('about_banner_image');
?>

<!-- Page Header with Background Image -->
<div class="relative py-24 bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="<?php echo e($innerPageBanner ? asset('storage/' . $innerPageBanner) : 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80'); ?>" alt="About Us Banner" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-serif">About Us</h1>
        <nav class="flex justify-center items-center gap-3 text-sm font-bold tracking-widest uppercase text-white/80">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-amber-400 transition-colors">HOME</a>
            <span class="text-white/40">/</span>
            <span class="text-amber-500">ABOUT US</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-24">
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                <img src="<?php echo e($aboutContentImage ? asset('storage/' . $aboutContentImage) : 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80'); ?>" alt="Diverse Community" class="w-full h-auto">
            </div>
            <div class="absolute -top-4 -left-4 text-amber-500">
                <i data-lucide="heart" class="w-12 h-12 fill-current opacity-20"></i>
            </div>
        </div>
        <div class="space-y-6">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 border-l-4 border-amber-500 pl-6">About Koodibhalona Trust</h2>
            <p class="text-amber-600 font-bold tracking-widest uppercase text-sm">The origin and motivation behind the trust.</p>
            <div class="text-slate-600 leading-relaxed space-y-4">
                <p>Koodibhalona Trust is a public charitable organization based in Bangalore, Karnataka, founded with a vision to serve humanity beyond the boundaries of caste, creed, gender, or religion. Established by Mr. Sai Jay Shankar B.C., the Trust is committed to creating a compassionate and inclusive society through impactful initiatives that touch every aspect of human life.</p>
                <p>At Koodibhalona Trust, we believe true progress begins when every individual has access to basic needs, equal opportunities, and the freedom to live with dignity. Our programs span across education, healthcare, women and child welfare, senior citizen care, environmental protection, rural development, cultural preservation, and social justice awareness.</p>
                <p>Guided by the principles of empathy, integrity, and community service, we work closely with local communities, volunteers, and partners to bring sustainable change where it's needed most. From organizing health camps and educational drives to empowering women and protecting the environment, each initiative is designed to build hope and strengthen society at its roots. Our mission is simple — to empower lives, nurture hope, and build a better tomorrow for generations to come.</p>
            </div>
        </div>
    </section>

    <!-- Sanatana Gyana Kirana (R) Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div class="space-y-8 lg:order-1">
            <div>
                <span class="text-amber-500 text-2xl">&#10070;</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2 font-serif">Sanatana Gyana Kirana (R)</h2>
            </div>

            
            <?php
                $kannadaText = \App\Models\SiteSetting::get('about_santana_kannada', "ಕಳಬೇಡ\nಕೊಲಬೇಡ\nಹುಸಿಯ ನುಡಿಯಲು ಬೇಡ\nಮುನಿಯಬೇಡ\nಅನ್ಯರಿಗೆ ಅಸಹ್ಯಪಡಬೇಡ\nತನ್ನ ಬಣ್ಣಿಸಬೇಡ\nಇದಿರ ಹಳಿಯಲು ಬೇಡ\nಇದೇ ಅಂತರಂಗಶುದ್ಧಿ ಇದೇ ಬಹಿರಂಗಶುದ್ಧಿ\nಇದೇ ನಮ್ಮ ಕೂಡಲಸಂಗಮದೇವರನೊಲಿಸುವ ಪರಿ.");
                $kannadaLines = array_filter(array_map('trim', preg_split('/\r?\n/', $kannadaText)));
            ?>
            <div class="space-y-1">
                <?php $__currentLoopData = $kannadaLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-amber-800 font-medium italic text-base leading-relaxed"><?php echo e($line); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php
                $desc1 = \App\Models\SiteSetting::get('about_santana_desc1', "At Sanatana Jnanakendra, we are devoted to preserving and spreading the essence of Sanatana Dharma. We regularly conduct poojas, homams, spiritual discourses, and Veda-Yoga classes to guide individuals toward spiritual growth and inner peace. Our goal is to help every person live a life enriched with devotion, discipline, and dharma.");
                $desc2 = \App\Models\SiteSetting::get('about_santana_desc2', "As a spiritual and religious trust, our mission is to revive the sacred values and practices that nurture the soul and strengthen the moral fabric of society. We conduct a wide range of activities that inspire faith, devotion, and self-realization.");
            ?>
            <div class="text-slate-600 leading-relaxed space-y-4">
                <div><?php echo nl2br(e($desc1)); ?></div>
                <div><?php echo nl2br(e($desc2)); ?></div>
            </div>
        </div>
        <div class="lg:order-2 sticky top-28">
            <div class="rounded-3xl overflow-hidden shadow-2xl">
                <?php $santanaImg = \App\Models\SiteSetting::get('about_santana_image'); ?>
                <img src="<?php echo e($santanaImg ? asset('storage/' . $santanaImg) : 'https://images.unsplash.com/photo-1548013146-7247d768b061?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80'); ?>" alt="Sacred Statue" class="w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Founder Section -->
    <section class="py-16 border-t border-slate-100">
        <div class="text-center max-w-4xl mx-auto mb-16 px-4">
            <h2 class="text-3xl font-bold text-slate-900 mb-8 pb-4 relative inline-block">
                Founder Self Introduction :
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-amber-500 rounded-full"></span>
            </h2>
            <div class="text-lg text-slate-700 leading-relaxed text-left">
                <?php echo nl2br(e(\App\Models\SiteSetting::get('about_founder_intro', 'Myself introduce 👍🏿 koodibalona trust and sanatana gnana Kirana trust founder president👌🏿 Master Of Art. Karnataka India and practicing , lecturer Advocate and legal consultant social worker and environmentalist👍🏿 and actor director producer. And artist. State level winner 👍🏿clay modelling, mimicry,drawing college art, modelling wedding photographer videographer, research work script writer Sports. Event organiser ,ete. Diploma certificate course of animal husbandry. Photography. Screen printing. Ete.'))); ?>

            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto px-4 mb-20">
            <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-200 aspect-[3/2] bg-slate-100 flex items-center justify-center">
                <?php $p1 = \App\Models\SiteSetting::get('about_founder_photo1'); ?>
                <?php if($p1): ?>
                    <img src="<?php echo e(asset('storage/' . $p1)); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <span class="text-slate-400 italic">Founder's Card / Profile Photo 1</span>
                <?php endif; ?>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-200 aspect-[3/2] bg-slate-100 flex items-center justify-center">
                <?php $p2 = \App\Models\SiteSetting::get('about_founder_photo2'); ?>
                <?php if($p2): ?>
                    <img src="<?php echo e(asset('storage/' . $p2)); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <span class="text-slate-400 italic">Founder's Card / Profile Photo 2</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-amber-600 text-white rounded-[2rem] p-10 md:p-16 text-center shadow-2xl relative overflow-hidden max-w-5xl mx-auto">
            <div class="absolute top-0 left-0 p-8 opacity-10">
                <i data-lucide="quote" class="w-24 h-24"></i>
            </div>
            <h3 class="text-2xl md:text-3xl font-bold mb-8 italic">"<?php echo e(\App\Models\SiteSetting::get('about_founder_quote', 'My trust Moto is love all server all. Leave together.')); ?>"</h3>
            <p class="text-amber-50 leading-relaxed text-lg max-w-3xl mx-auto">
                <?php echo e(\App\Models\SiteSetting::get('about_founder_quote_desc', 'My trust Moto is love all server all. Leave together. Supporting disable person women empowerment, trainings, all type of for the development of poor and other persons, self help groups, matrimonial, real estate, construction and developments, support to the all religions people in worldwide. Etc')); ?>

            </p>
        </div>
    </section>

    <!-- Team Members Section -->
    <?php if(isset($teamMembers) && $teamMembers->count() > 0): ?>
    <section class="py-16 border-t border-slate-100">
        <div class="text-center max-w-4xl mx-auto mb-16 px-4">
            <h2 class="text-3xl font-bold text-slate-900 mb-8 pb-4 relative inline-block">
                Our Team
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-amber-500 rounded-full"></span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
            <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden group hover:shadow-2xl transition-all">
                <div class="aspect-square bg-slate-100 relative overflow-hidden">
                    <?php if($member->photo_path): ?>
                        <img src="<?php echo e(asset('storage/' . $member->photo_path)); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-8 text-center bg-white relative">
                    <h3 class="text-xl font-bold text-slate-900 mb-1"><?php echo e($member->name); ?></h3>
                    <p class="text-amber-600 font-bold text-sm uppercase tracking-wider mb-4"><?php echo e($member->role); ?></p>
                    <?php if($member->description): ?>
                        <p class="text-slate-600 text-sm leading-relaxed"><?php echo e($member->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Vision & Mission -->
    <section class="pt-16 border-t border-slate-100">
        <div class="text-center max-w-4xl mx-auto mb-16 px-4">
            <h2 class="text-3xl font-bold text-slate-900 mb-8 pb-4 relative inline-block">
                Vision & Mission
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-amber-500 rounded-full"></span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="flex flex-col items-center text-center p-12 rounded-[2.5rem] bg-white border border-slate-200 group transition-all hover:shadow-xl hover:-translate-y-2">
                <div class="w-20 h-20 rounded-2xl bg-white shadow-lg flex items-center justify-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-6">Vision</h3>
                <p class="text-slate-600 leading-relaxed"><?php echo e(\App\Models\SiteSetting::get('about_vision', 'A society where every individual has access to education, healthcare, equality, and opportunities to thrive with dignity.')); ?></p>
            </div>
            <div class="flex flex-col items-center text-center p-12 rounded-[2.5rem] bg-white border border-slate-200 group transition-all hover:shadow-xl hover:-translate-y-2">
                <div class="w-20 h-20 rounded-2xl bg-white shadow-lg flex items-center justify-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-6">Mission</h3>
                <p class="text-slate-600 leading-relaxed"><?php echo e(\App\Models\SiteSetting::get('about_mission', 'Empower communities through education, health, welfare, and environmental programs, creating lasting impact.')); ?></p>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\varalakshmi\Desktop\charity\koodibhalona\resources\views/about.blade.php ENDPATH**/ ?>