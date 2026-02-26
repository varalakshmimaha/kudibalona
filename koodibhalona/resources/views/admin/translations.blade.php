@extends('layouts.admin')

@section('title', 'Manage Translations')
@section('header', 'Translation Overrides')

@section('content')
<div class="space-y-8">
    <!-- Add New Translation -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.translations.store') }}" method="POST" class="p-8">
            @csrf
            <h3 class="text-lg font-bold text-gray-800 mb-6">Add Custom Translation</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Original English Word</label>
                    <input type="text" name="english_word" placeholder="e.g. Koodibhalona" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Required Kannada Translation</label>
                    <input type="text" name="kannada_word" placeholder="e.g. ಕೂಡಿಬಾಳೋಣ" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500" required>
                </div>
                <div>
                    <button type="submit" class="w-full px-6 py-3 bg-amber-500 text-white rounded-xl font-bold shadow-lg shadow-amber-500/30 hover:bg-amber-600 transition-colors flex items-center justify-center">
                        <i data-lucide="plus" class="w-5 h-5 mr-2"></i> Add Translation Override
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Existing Translations List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <i data-lucide="languages" class="w-6 h-6 mr-3 text-amber-500"></i> Active Overrides
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        <th class="p-5 font-semibold">Original (English)</th>
                        <th class="p-5 font-semibold">Translation (Kannada)</th>
                        <th class="p-5 font-semibold">Status</th>
                        <th class="p-5 font-semibold w-40 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($translations as $item)
                    <!-- Display Row -->
                    <tr class="hover:bg-gray-50/50 transition-colors group" id="row-{{ $item->id }}">
                        <td class="p-5 text-gray-700 font-medium {{ $item->is_hidden ? 'opacity-50 line-through' : '' }}">{{ $item->english_word }}</td>
                        <td class="p-5 text-gray-900 font-bold font-serif {{ $item->is_hidden ? 'opacity-50' : '' }}">{{ $item->kannada_word }}</td>
                        <td class="p-5">
                            @if($item->is_hidden)
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase tracking-wider">Hidden</span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">Active</span>
                            @endif
                        </td>
                        <td class="p-5 text-center whitespace-nowrap">
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('edit-{{ $item->id }}').classList.remove('hidden'); document.getElementById('row-{{ $item->id }}').classList.add('hidden')" class="p-2 text-gray-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Translation">
                                <i data-lucide="edit-2" class="w-5 h-5"></i>
                            </button>
                            
                            <!-- Toggle Hide/Show Form -->
                            <form action="{{ route('admin.translations.toggle', $item->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 text-gray-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors" title="{{ $item->is_hidden ? 'Show' : 'Hide' }} Translation">
                                    <i data-lucide="{{ $item->is_hidden ? 'eye' : 'eye-off' }}" class="w-5 h-5"></i>
                                </button>
                            </form>
                            
                            <!-- Delete Form -->
                            <form action="{{ route('admin.translations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this translation override?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete Override">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Edit Form Row (Hidden by default) -->
                    <tr id="edit-{{ $item->id }}" class="hidden bg-amber-50/50">
                        <td colspan="4" class="p-5">
                            <form action="{{ route('admin.translations.update', $item->id) }}" method="POST" class="flex gap-4 items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="english_word" value="{{ $item->english_word }}" class="flex-1 px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500" required>
                                <input type="text" name="kannada_word" value="{{ $item->kannada_word }}" class="flex-1 px-4 py-2 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500" required>
                                
                                <button type="submit" class="px-4 py-2 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600 transition-colors">
                                    Save
                                </button>
                                <button type="button" onclick="document.getElementById('edit-{{ $item->id }}').classList.add('hidden'); document.getElementById('row-{{ $item->id }}').classList.remove('hidden')" class="px-4 py-2 bg-white border border-gray-200 text-gray-600 font-bold rounded-lg hover:bg-gray-50 transition-colors">
                                    Cancel
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-10 text-center text-gray-400">
                            <i data-lucide="book-x" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                            <p>No translation overrides added yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
