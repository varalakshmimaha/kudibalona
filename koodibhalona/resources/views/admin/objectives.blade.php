@extends('layouts.admin')

@section('title', 'Manage Objectives')
@section('header', 'Objectives')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-xl font-bold text-gray-800">Objectives Section</h3>
            <p class="text-gray-500 text-sm mt-1">Manage the objectives list, YouTube video, and section image.</p>
        </div>

        <form action="{{ route('admin.objectives.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            
            <!-- YouTube Video -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">YouTube URL</label>
                <input type="text" name="youtube_url" value="{{ old('youtube_url', $objective->youtube_url) }}" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                    placeholder="https://www.youtube.com/watch?v=...">
                <p class="text-[10px] text-gray-400">You can paste any normal YouTube URL (watch, youtu.be, shorts). It will be displayed as a playable video on the homepage.</p>
            </div>

            <!-- Image Section -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">Section Image</label>
                <div class="flex items-center gap-8">
                    @if($objective->image)
                        <div class="w-40 h-24 rounded-xl border border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $objective->image) }}" alt="Current Image" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <div class="flex-grow">
                        <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all">
                    </div>
                </div>
            </div>

            <!-- List Items -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700">Trust Objectives (One per line)</label>
                <div id="items-container" class="space-y-3">
                    @php
                        $existingItems = old('list_items', $objective->list_items ?? []);
                        $existingItems = is_array($existingItems) ? $existingItems : [];
                    @endphp
                    @forelse($existingItems as $item)
                    <div class="flex gap-2">
                        <input type="text" name="list_items[]" value="{{ $item }}" class="flex-grow px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                    </div>
                    @empty
                    <div class="flex gap-2">
                        <input type="text" name="list_items[]" class="flex-grow px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addItem()" class="mt-4 flex items-center text-sm font-bold text-amber-600 hover:text-amber-700">
                    <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i> Add New Objective
                </button>
            </div>

            <div class="pt-8 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg shadow-amber-500/20 transform hover:-translate-y-0.5 transition-all uppercase tracking-widest text-xs">
                    Save Objectives
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addItem() {
        const container = document.getElementById('items-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
            <input type="text" name="list_items[]" class="flex-grow px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
            <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
        `;
        container.appendChild(div);
        lucide.createIcons();
    }
</script>
@endsection
