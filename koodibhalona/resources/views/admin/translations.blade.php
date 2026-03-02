@extends('layouts.admin')

@section('title', 'Manage Translations')
@section('header', 'Dynamic Translation Keywords')

@section('styles')
<style>
    .lang-tab { transition: all 0.2s; cursor: pointer; }
    .lang-tab.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
    .lang-pane { display: none; }
    .lang-pane.active { display: table-cell; }
    .cell-input { width: 100%; padding: 6px 10px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 13px; background: #f9fafb; }
    .cell-input:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 2px rgba(245,158,11,0.15); background: #fff; }
    .badge { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
    .badge-active { background: #d1fae5; color: #065f46; }
    .badge-hidden { background: #f3f4f6; color: #6b7280; }
    .badge-cat { background: #ede9fe; color: #5b21b6; }
    tr.edit-row { background: #fffbeb; }
    .add-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    @media (max-width: 900px) { .add-form-grid { grid-template-columns: 1fr; } }
    .section-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; margin-bottom: 4px; }
    .search-box { padding: 8px 14px; border: 1.5px solid #e5e7eb; border-radius: 10px; font-size: 13px; min-width: 200px; outline: none; }
    .search-box:focus { border-color: #f59e0b; box-shadow: 0 0 0 2px rgba(245,158,11,0.13); }
    .lang-col-header { cursor: pointer; user-select: none; white-space: nowrap; }
    .lang-col-header:hover { color: #b45309; }
    .lang-col-header.active-lang { color: #b45309; font-weight: 800; }
    .filter-cat { padding: 4px 12px; border-radius: 999px; border: 1.5px solid #e5e7eb; font-size: 12px; font-weight: 600; cursor: pointer; background: #fff; transition: all 0.15s; }
    .filter-cat.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
    .empty-col { color: #d1d5db; font-style: italic; font-size: 12px; }
    .progress-bar { height: 4px; border-radius: 2px; background: #e5e7eb; overflow: hidden; width: 80px; display: inline-block; vertical-align: middle; margin-left: 6px; }
    .progress-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, #f59e0b, #fbbf24); }
</style>
@endsection

@section('content')

@php
    $categoryOptions = ['general', 'navigation', 'hero', 'about', 'services', 'contact', 'footer', 'buttons', 'forms'];
    $langCodes = ['kn', 'te', 'hi', 'ta'];
@endphp

<div class="space-y-6">

    {{-- Page Description --}}
    <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-5 flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
            <i data-lucide="languages" class="w-5 h-5 text-amber-600"></i>
        </div>
        <div>
            <h3 class="font-bold text-amber-900 mb-1">How Dynamic Keywords Work</h3>
            <p class="text-sm text-amber-800 leading-relaxed">
                Add an <strong>English keyword</strong> (any word or phrase from the website) and its translations in Kannada, Telugu, Hindi, and Tamil.
                When a visitor switches language, these keywords are automatically replaced across the entire website in real-time —
                no page reload needed. Add translations for as many or as few languages as you like.
            </p>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
        @php
            $total  = $translations->count();
            $active = $translations->where('is_hidden', false)->count();
            $knCount = $translations->whereNotNull('kannada_word')->where('kannada_word', '!=', '')->count();
            $teCount = $translations->whereNotNull('telugu_word')->where('telugu_word', '!=', '')->count();
            $hiCount = $translations->whereNotNull('hindi_word')->where('hindi_word', '!=', '')->count();
            $taCount = $translations->whereNotNull('tamil_word')->where('tamil_word', '!=', '')->count();
        @endphp
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-bold text-gray-800">{{ $total }}</div>
            <div class="text-xs text-gray-500 mt-1">Total Keywords</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-bold text-green-600">{{ $active }}</div>
            <div class="text-xs text-gray-500 mt-1">Active</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
            <div class="text-lg font-bold text-amber-600">{{ $total > 0 ? round($knCount / $total * 100) : 0 }}%</div>
            <div class="text-xs text-gray-500 mt-1">🇮🇳 Kannada</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
            <div class="text-lg font-bold text-blue-600">{{ $total > 0 ? round($teCount / $total * 100) : 0 }}%</div>
            <div class="text-xs text-gray-500 mt-1">🇮🇳 Telugu</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
            <div class="text-lg font-bold text-purple-600">{{ $total > 0 ? round($hiCount / $total * 100) : 0 }}%</div>
            <div class="text-xs text-gray-500 mt-1">🇮🇳 Hindi</div>
        </div>
    </div>

    {{-- ─── ADD NEW KEYWORD FORM ─── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50/60 flex items-center justify-between">
            <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-5 h-5 text-amber-500"></i>
                Add New Translation Keyword
            </h3>
            <button type="button" onclick="toggleAddForm()" id="add-toggle-btn"
                class="text-sm font-semibold text-amber-600 hover:text-amber-700 flex items-center gap-1">
                <i data-lucide="chevron-down" class="w-4 h-4" id="add-chevron"></i>
                Expand
            </button>
        </div>

        <div id="add-form-body" class="hidden p-6">
            <form action="{{ route('admin.translations.store') }}" method="POST">
                @csrf

                <div class="add-form-grid mb-5">
                    <div>
                        <div class="section-label">English Keyword / Phrase *</div>
                        <input type="text" name="english_word" required
                            placeholder="e.g. About Us, Koodibhalona Trust, Join Us Today"
                            class="cell-input w-full">
                        <p class="text-xs text-gray-400 mt-1">This is the exact text that appears on the website</p>
                    </div>
                    <div>
                        <div class="section-label">Description (optional)</div>
                        <input type="text" name="description"
                            placeholder="e.g. Navigation link label, Hero section title"
                            class="cell-input w-full">
                        <p class="text-xs text-gray-400 mt-1">Helps you remember where this keyword appears</p>
                    </div>
                </div>

                <div class="section-label mb-3">Translations — fill in the languages you want to support</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
                    <div class="bg-amber-50 rounded-xl p-4 border border-amber-100">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">🇮🇳</span>
                            <span class="text-sm font-bold text-amber-800">ಕನ್ನಡ (Kannada)</span>
                        </div>
                        <input type="text" name="kannada_word" placeholder="ಕನ್ನಡ ಅನುವಾದ..." class="cell-input" dir="auto">
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">🇮🇳</span>
                            <span class="text-sm font-bold text-blue-800">తెలుగు (Telugu)</span>
                        </div>
                        <input type="text" name="telugu_word" placeholder="తెలుగు అనువాదం..." class="cell-input" dir="auto">
                    </div>
                    <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">🇮🇳</span>
                            <span class="text-sm font-bold text-green-800">हिन्दी (Hindi)</span>
                        </div>
                        <input type="text" name="hindi_word" placeholder="हिन्दी अनुवाद..." class="cell-input" dir="auto">
                    </div>
                    <div class="bg-rose-50 rounded-xl p-4 border border-rose-100">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">🇮🇳</span>
                            <span class="text-sm font-bold text-rose-800">தமிழ் (Tamil)</span>
                        </div>
                        <input type="text" name="tamil_word" placeholder="தமிழ் மொழிபெயர்ப்பு..." class="cell-input" dir="auto">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="section-label mb-1">Category</div>
                        <select name="category" class="cell-input" style="max-width:200px">
                            @foreach($categoryOptions as $cat)
                                <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-3 bg-amber-500 text-white rounded-xl font-bold shadow-lg shadow-amber-500/25 hover:bg-amber-600 transition-all">
                        <i data-lucide="plus" class="w-5 h-5"></i> Add Keyword
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ─── KEYWORDS TABLE ─── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Table Header / Filters --}}
        <div class="p-5 border-b border-gray-100 bg-gray-50/50">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                    <i data-lucide="table-2" class="w-5 h-5 text-amber-500"></i>
                    Translation Keywords
                    <span class="ml-2 px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">{{ $total }}</span>
                </h3>
                <div class="flex flex-wrap items-center gap-3">
                    {{-- Search --}}
                    <input type="text" id="kw-search" placeholder="🔍 Search keywords..."
                        class="search-box" onkeyup="filterKeywords()">
                    {{-- Category filter --}}
                    <div class="flex flex-wrap gap-2" id="cat-filters">
                        <button class="filter-cat active" onclick="filterCat('', this)">All</button>
                        @foreach($categories->unique()->sort()->values() as $cat)
                            <button class="filter-cat" onclick="filterCat('{{ $cat }}', this)">{{ ucfirst($cat) }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm" id="kw-table">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 font-semibold uppercase tracking-wider">
                        <th class="p-4 min-w-[180px]">English Keyword</th>
                        <th class="p-4 min-w-[120px]">
                            <button class="lang-col-header active-lang" onclick="highlightLang('kn', this)" id="lh-kn">
                                🇮🇳 Kannada
                            </button>
                        </th>
                        <th class="p-4 min-w-[120px]">
                            <button class="lang-col-header" onclick="highlightLang('te', this)" id="lh-te">
                                🇮🇳 Telugu
                            </button>
                        </th>
                        <th class="p-4 min-w-[120px]">
                            <button class="lang-col-header" onclick="highlightLang('hi', this)" id="lh-hi">
                                🇮🇳 Hindi
                            </button>
                        </th>
                        <th class="p-4 min-w-[120px]">
                            <button class="lang-col-header" onclick="highlightLang('ta', this)" id="lh-ta">
                                🇮🇳 Tamil
                            </button>
                        </th>
                        <th class="p-4 w-28">Category</th>
                        <th class="p-4 w-24 text-center">Status</th>
                        <th class="p-4 w-36 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" id="kw-tbody">
                    @forelse($translations as $item)

                    {{-- ── View Row ── --}}
                    <tr class="hover:bg-gray-50/40 transition-colors group kw-row"
                        id="row-{{ $item->id }}"
                        data-category="{{ $item->category }}"
                        data-search="{{ strtolower($item->english_word . ' ' . $item->description . ' ' . $item->category) }}">
                        <td class="p-4">
                            <div class="font-semibold text-gray-800 {{ $item->is_hidden ? 'opacity-40 line-through' : '' }}">
                                {{ $item->english_word }}
                            </div>
                            @if($item->description)
                                <div class="text-xs text-gray-400 mt-0.5">{{ $item->description }}</div>
                            @endif
                        </td>
                        <td class="p-4 lang-cell" data-lang="kn">
                            @if($item->kannada_word)
                                <span class="font-medium text-gray-700">{{ $item->kannada_word }}</span>
                            @else
                                <span class="empty-col">—</span>
                            @endif
                        </td>
                        <td class="p-4 lang-cell" data-lang="te">
                            @if($item->telugu_word)
                                <span class="font-medium text-gray-700">{{ $item->telugu_word }}</span>
                            @else
                                <span class="empty-col">—</span>
                            @endif
                        </td>
                        <td class="p-4 lang-cell" data-lang="hi">
                            @if($item->hindi_word)
                                <span class="font-medium text-gray-700">{{ $item->hindi_word }}</span>
                            @else
                                <span class="empty-col">—</span>
                            @endif
                        </td>
                        <td class="p-4 lang-cell" data-lang="ta">
                            @if($item->tamil_word)
                                <span class="font-medium text-gray-700">{{ $item->tamil_word }}</span>
                            @else
                                <span class="empty-col">—</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <span class="badge badge-cat">{{ $item->category ?: 'general' }}</span>
                        </td>
                        <td class="p-4 text-center">
                            @if($item->is_hidden)
                                <span class="badge badge-hidden">Hidden</span>
                            @else
                                <span class="badge badge-active">Active</span>
                            @endif
                        </td>
                        <td class="p-4 text-center whitespace-nowrap">
                            <button onclick="showEdit({{ $item->id }})"
                                title="Edit"
                                class="inline-flex p-1.5 text-gray-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                            </button>
                            <form action="{{ route('admin.translations.toggle', $item->id) }}" method="POST" class="inline-block">
                                @csrf @method('PATCH')
                                <button type="submit" title="{{ $item->is_hidden ? 'Show' : 'Hide' }}"
                                    class="inline-flex p-1.5 text-gray-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                                    @if($item->is_hidden)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                    @endif
                                </button>
                            </form>
                            <form id="del-form-{{ $item->id }}" action="{{ route('admin.translations.destroy', $item->id) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="button" title="Delete" onclick="if(confirm('Delete this keyword?')) document.getElementById('del-form-{{ $item->id }}').submit();"
                                    class="inline-flex p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- ── Edit Row (hidden by default) ── --}}
                    <tr id="edit-{{ $item->id }}" class="hidden bg-amber-50/60 border-b border-amber-100">
                        <td colspan="8" class="p-5">
                            <form action="{{ route('admin.translations.update', $item->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                                    <div>
                                        <div class="section-label mb-1">English Keyword *</div>
                                        <input type="text" name="english_word" value="{{ $item->english_word }}"
                                            required class="cell-input">
                                    </div>
                                    <div>
                                        <div class="section-label mb-1">Description</div>
                                        <input type="text" name="description" value="{{ $item->description }}"
                                            placeholder="Where does this appear?" class="cell-input">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                    <div class="bg-amber-50 rounded-lg p-3 border border-amber-100">
                                        <div class="section-label mb-1">🇮🇳 Kannada</div>
                                        <input type="text" name="kannada_word" value="{{ $item->kannada_word }}"
                                            placeholder="ಕನ್ನಡ..." class="cell-input" dir="auto">
                                    </div>
                                    <div class="bg-blue-50 rounded-lg p-3 border border-blue-100">
                                        <div class="section-label mb-1">🇮🇳 Telugu</div>
                                        <input type="text" name="telugu_word" value="{{ $item->telugu_word }}"
                                            placeholder="తెలుగు..." class="cell-input" dir="auto">
                                    </div>
                                    <div class="bg-green-50 rounded-lg p-3 border border-green-100">
                                        <div class="section-label mb-1">🇮🇳 Hindi</div>
                                        <input type="text" name="hindi_word" value="{{ $item->hindi_word }}"
                                            placeholder="हिन्दी..." class="cell-input" dir="auto">
                                    </div>
                                    <div class="bg-rose-50 rounded-lg p-3 border border-rose-100">
                                        <div class="section-label mb-1">🇮🇳 Tamil</div>
                                        <input type="text" name="tamil_word" value="{{ $item->tamil_word }}"
                                            placeholder="தமிழ்..." class="cell-input" dir="auto">
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-wrap">
                                    <div>
                                        <div class="section-label mb-1">Category</div>
                                        <select name="category" class="cell-input" style="min-width:140px">
                                            @foreach($categoryOptions as $cat)
                                                <option value="{{ $cat }}" {{ $item->category == $cat ? 'selected' : '' }}>
                                                    {{ ucfirst($cat) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex gap-2 items-end">
                                        <button type="submit"
                                            class="px-5 py-2 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition-colors">
                                            Save Changes
                                        </button>
                                        <button type="button" onclick="hideEdit({{ $item->id }})"
                                            class="px-5 py-2 bg-white border border-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr id="no-keywords">
                        <td colspan="8" class="p-14 text-center text-gray-400">
                            <i data-lucide="book-open" class="w-12 h-12 mx-auto mb-3 opacity-30"></i>
                            <p class="font-medium">No translation keywords yet.</p>
                            <p class="text-sm mt-1">Click "Add New Translation Keyword" above to get started.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- No search results row --}}
        <div id="no-results" class="hidden p-10 text-center text-gray-400">
            <i data-lucide="search-x" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
            <p>No keywords match your search.</p>
        </div>
    </div>

    {{-- Quick Tips --}}
    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5">
        <h4 class="font-bold text-slate-700 mb-3 flex items-center gap-2">
            <i data-lucide="lightbulb" class="w-4 h-4 text-amber-500"></i> Tips for Best Results
        </h4>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-slate-600">
            <div class="flex items-start gap-2">
                <span class="text-amber-500 font-bold mt-0.5">1.</span>
                <span>Enter the <strong>exact English text</strong> that appears on the website — matching is case-insensitive.</span>
            </div>
            <div class="flex items-start gap-2">
                <span class="text-amber-500 font-bold mt-0.5">2.</span>
                <span>You can translate into <strong>one or all languages</strong> — empty fields are silently skipped.</span>
            </div>
            <div class="flex items-start gap-2">
                <span class="text-amber-500 font-bold mt-0.5">3.</span>
                <span>New keywords take effect <strong>instantly</strong> when visitors switch language — no reload needed.</span>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // ── Add form toggle ──
    function toggleAddForm() {
        const body = document.getElementById('add-form-body');
        const btn  = document.getElementById('add-toggle-btn');
        const chev = document.getElementById('add-chevron');
        const open = body.classList.contains('hidden');
        body.classList.toggle('hidden', !open);
        btn.innerHTML = open
            ? '<i data-lucide="chevron-up" class="w-4 h-4"></i> Collapse'
            : '<i data-lucide="chevron-down" class="w-4 h-4"></i> Expand';
        lucide.createIcons();
    }

    // ── Edit row show/hide ──
    function showEdit(id) {
        document.getElementById('row-' + id).classList.add('hidden');
        document.getElementById('edit-' + id).classList.remove('hidden');
    }
    function hideEdit(id) {
        document.getElementById('edit-' + id).classList.add('hidden');
        document.getElementById('row-' + id).classList.remove('hidden');
    }

    // ── Language column highlight ──
    let activeLang = 'kn';
    function highlightLang(lang, el) {
        activeLang = lang;
        document.querySelectorAll('.lang-col-header').forEach(b => b.classList.remove('active-lang'));
        el.classList.add('active-lang');
        // Highlight cells for that language
        document.querySelectorAll('.lang-cell').forEach(td => {
            td.style.background = td.dataset.lang === lang ? 'rgba(245,158,11,0.06)' : '';
        });
    }

    // ── Category filter ──
    let activeCat = '';
    function filterCat(cat, el) {
        activeCat = cat;
        document.querySelectorAll('.filter-cat').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        applyFilters();
    }

    // ── Search filter ──
    function filterKeywords() {
        applyFilters();
    }

    function applyFilters() {
        const q   = document.getElementById('kw-search').value.toLowerCase();
        const rows = document.querySelectorAll('.kw-row');
        let visible = 0;
        rows.forEach(row => {
            const searchData = row.dataset.search || '';
            const cat        = row.dataset.category || '';
            const matchQ     = !q || searchData.includes(q);
            const matchCat   = !activeCat || cat === activeCat;
            const show       = matchQ && matchCat;
            row.style.display = show ? '' : 'none';
            // also hide corresponding edit row
            const rowId = row.id.replace('row-', '');
            const editRow = document.getElementById('edit-' + rowId);
            if (editRow) editRow.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        const noResults = document.getElementById('no-results');
        noResults.classList.toggle('hidden', visible > 0);
    }

    // Auto‑open add form if validation errors
    @if($errors->any())
        toggleAddForm();
    @endif
</script>
@endsection
