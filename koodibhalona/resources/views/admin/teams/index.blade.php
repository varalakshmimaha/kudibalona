@extends('layouts.admin')

@section('title', 'Manage Team Members')
@section('header', 'Team Members')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h3 class="text-xl font-bold text-gray-800">All Team Members</h3>
    <a href="{{ route('admin.teams.create') }}" class="px-6 py-2.5 bg-amber-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-amber-500/20 hover:scale-105 transition-all flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Add New Team Member
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Photo</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Details</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Order</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($teamMembers as $team)
            <tr>
                <td class="px-6 py-4">
                    @if($team->photo_path)
                        <img src="{{ asset('storage/' . $team->photo_path) }}" class="w-16 h-16 object-cover rounded-full border border-gray-200" alt="">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                            <i data-lucide="user" class="w-8 h-8"></i>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="font-bold text-gray-900">{{ $team->name }}</div>
                    <div class="text-xs text-amber-600 font-medium uppercase tracking-tighter">{{ $team->role }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $team->order }}</td>
                <td class="px-6 py-4">
                    @if($team->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Active</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-end space-x-3 text-sm">
                        <a href="{{ route('admin.teams.edit', $team) }}" class="flex items-center text-blue-600 hover:text-blue-800 transition-colors font-medium">
                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center text-red-600 hover:text-red-800 transition-colors font-medium">
                                <i data-lucide="trash" class="w-4 h-4 mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No team members found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
