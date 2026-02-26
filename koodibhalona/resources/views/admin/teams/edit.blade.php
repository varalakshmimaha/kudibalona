@extends('layouts.admin')

@section('title', 'Edit Team Member')
@section('header', 'Team Members')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-xl font-bold text-gray-800">Edit Team Member</h3>
        <a href="{{ route('admin.teams.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800">
            <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i> Back to Teams
        </a>
    </div>

    <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ $team->name }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Role/Position</label>
                    <input type="text" name="role" value="{{ $team->role }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description / Bio</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500">{{ $team->description }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Photo</label>
                @if($team->photo_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $team->photo_path) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200">
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current photo.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="order" value="{{ $team->order }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500" required>
                </div>
                <div class="flex items-center mt-8">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $team->is_active ? 'checked' : '' }} class="w-5 h-5 text-amber-500 bg-gray-100 border-gray-300 rounded focus:ring-amber-500">
                    <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700">Active (Visible on website)</label>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100">
                <button type="submit" class="px-8 py-3 bg-amber-500 text-white font-bold rounded-xl shadow-lg shadow-amber-500/30 hover:bg-amber-600 transition-colors">
                    Update Team Member
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
