@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Header Section -->
<div class="bg-white py-16 text-center">
    <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">About Us</h1>
    <nav class="flex justify-center items-center gap-2 text-sm font-medium">
        <a href="{{ route('home') }}" class="text-amber-600 hover:text-amber-700">Home</a>
        <span class="text-slate-400">/</span>
        <a href="{{ route('contact') }}" class="text-amber-600 hover:text-amber-700">Contact us</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-500">About us</span>
    </nav>
</div>

<!-- Main Banner -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 mb-20">
    <div class="rounded-3xl overflow-hidden shadow-2xl h-[300px] md:h-[450px]">
        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Community Support" class="w-full h-full object-cover">
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-32 mb-24">
    <!-- About Koodibhalona Trust Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80" alt="Diverse Community" class="w-full h-auto">
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
                <p>Guided by the principles of empathy, integrity, and community service, we work closely with local communities, volunteers, and partners to bring sustainable change where it’s needed most. From organizing health camps and educational drives to empowering women and protecting the environment, each initiative is designed to build hope and strengthen society at its roots. Our mission is simple — to empower lives, nurture hope, and build a better tomorrow for generations to come.</p>
            </div>
        </div>
    </section>

    <!-- Sanatana Gyana Kirana (R) Section -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-6 lg:order-1">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 flex items-center gap-3">
                <span class="w-10 h-[2px] bg-amber-500"></span>
                Sanatana Gyana Kirana (R)
            </h2>
            <div class="bg-amber-50/50 p-8 rounded-3xl border border-amber-100 mb-8 whitespace-pre-line text-center italic font-medium text-slate-800 leading-relaxed font-serif">
                {{ \App\Models\SiteSetting::get('about_santana_kannada', "ಕಳಬೇಡ\nಕೊಲಬೇಡ\nಹುಸಿಯ ನುಡಿಯಲು ಬೇಡ\nಮುನಿಯಬೇಡ\nಅನ್ಯರಿಗೆ ಅಸಹ್ಯಪಡಬೇಡ\nತನ್ನ ಬಣ್ಣಿಸಬೇಡ\nಇದಿರ ಹಳಿಯಲು ಬೇಡ\nಇದೇ ಅಂತರಂಗಶುದ್ಧಿ ಇದೇ ಬಹಿರಂಗಶುದ್ಧಿ\nಇದೇ ನಮ್ಮ ಕೂಡಲಸಂಗಮದೇವರನೊಲಿಸುವ ಪರಿ.") }}
            </div>
            <div class="text-slate-600 leading-relaxed space-y-4">
                <p>{{ \App\Models\SiteSetting::get('about_santana_desc1', "At Sanatana Jnanakendra, we are devoted to preserving and spreading the essence of Sanatana Dharma. We regularly conduct poojas, homams, spiritual discourses, and Veda–Yoga classes to guide individuals toward spiritual growth and inner peace. Our goal is to help every person live a life enriched with devotion, discipline, and dharma.") }}</p>
                <p>{{ \App\Models\SiteSetting::get('about_santana_desc2', "As a spiritual and religious trust, our mission is to revive the sacred values and practices that nurture the soul and strengthen the moral fabric of society. We conduct a wide range of activities that inspire faith, devotion, and self-realization.") }}</p>
            </div>
        </div>
        <div class="lg:order-2">
            <div class="rounded-3xl overflow-hidden shadow-2xl">
                @php $santanaImg = \App\Models\SiteSetting::get('about_santana_image'); @endphp
                <img src="{{ $santanaImg ? asset('storage/' . $santanaImg) : 'https://images.unsplash.com/photo-1548013146-7247d768b061?ixlib=rb-4.0.3&auto=format&fit=crop&w=1740&q=80' }}" alt="Sacred Statue" class="w-full h-auto">
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
            <p class="text-lg text-slate-700 leading-relaxed">
                {{ \App\Models\SiteSetting::get('about_founder_intro', 'Myself introduce koodibalona trust and sanatana gnana Kirana trust founder president Master Of Art. Karnataka India and practicing , lecturer Advocate and legal consultant social worker and environmentalist and actor director producer. And artist. State level winner clay modelling, mimicry,drawing college art, modelling wedding photographer videographer, research work script writer Sports. Event organiser ,ete. Diploma certificate course of animal husbandry. Photography. Screen printing. Ete.') }}
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto px-4 mb-20">
            <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-200 aspect-[3/2] bg-slate-100 flex items-center justify-center">
                @php $p1 = \App\Models\SiteSetting::get('about_founder_photo1'); @endphp
                @if($p1)
                    <img src="{{ asset('storage/' . $p1) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-slate-400 italic">Founder's Card / Profile Photo 1</span>
                @endif
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl border border-slate-200 aspect-[3/2] bg-slate-100 flex items-center justify-center">
                @php $p2 = \App\Models\SiteSetting::get('about_founder_photo2'); @endphp
                @if($p2)
                    <img src="{{ asset('storage/' . $p2) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-slate-400 italic">Founder's Card / Profile Photo 2</span>
                @endif
            </div>
        </div>
        <div class="bg-amber-600 text-white rounded-[2rem] p-10 md:p-16 text-center shadow-2xl relative overflow-hidden max-w-5xl mx-auto">
            <div class="absolute top-0 left-0 p-8 opacity-10">
                <i data-lucide="quote" class="w-24 h-24"></i>
            </div>
            <h3 class="text-2xl md:text-3xl font-bold mb-8 italic">"{{ \App\Models\SiteSetting::get('about_founder_quote', 'My trust Moto is love all server all. Leave together.') }}"</h3>
            <p class="text-amber-50 leading-relaxed text-lg max-w-3xl mx-auto">
                {{ \App\Models\SiteSetting::get('about_founder_quote_desc', 'Supporting disable person women empowerment, trainings, all type of for the development of poor and other persons, self help groups, matrimonial, real estate, construction and developments, support to the all religions people in worldwide. Etc') }}
            </p>
        </div>
    </section>

    <!-- Team Members Section -->
    @if(isset($teamMembers) && $teamMembers->count() > 0)
    <section class="py-16 border-t border-slate-100">
        <div class="text-center max-w-4xl mx-auto mb-16 px-4">
            <h2 class="text-3xl font-bold text-slate-900 mb-8 pb-4 relative inline-block">
                Our Team
                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-1 bg-amber-500 rounded-full"></span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
            @foreach($teamMembers as $member)
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden group hover:shadow-2xl transition-all">
                <div class="aspect-square bg-slate-100 relative overflow-hidden">
                    @if($member->photo_path)
                        <img src="{{ asset('storage/' . $member->photo_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-8 text-center bg-white relative">
                    <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h3>
                    <p class="text-amber-600 font-bold text-sm uppercase tracking-wider mb-4">{{ $member->role }}</p>
                    @if($member->description)
                        <p class="text-slate-600 text-sm leading-relaxed">{{ Str::limit($member->description, 150) }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Vision & Mission -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 pt-16 border-t border-slate-100">
        <div class="flex flex-col items-center text-center p-12 rounded-[2.5rem] bg-white border border-slate-200 group transition-all hover:shadow-xl hover:-translate-y-2">
            <div class="w-20 h-20 rounded-2xl bg-white shadow-lg flex items-center justify-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-6">Vision</h3>
            <p class="text-slate-600 leading-relaxed">{{ \App\Models\SiteSetting::get('about_vision', 'A society where every individual has access to education, healthcare, equality, and opportunities to thrive with dignity.') }}</p>
        </div>
        <div class="flex flex-col items-center text-center p-12 rounded-[2.5rem] bg-white border border-slate-200 group transition-all hover:shadow-xl hover:-translate-y-2">
            <div class="w-20 h-20 rounded-2xl bg-white shadow-lg flex items-center justify-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-6">Mission</h3>
            <p class="text-slate-600 leading-relaxed">{{ \App\Models\SiteSetting::get('about_mission', 'Empower communities through education, health, welfare, and environmental programs, creating lasting impact.') }}</p>
        </div>
    </section>
</div>

@endsection
