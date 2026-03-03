@extends('layouts.admin')

@section('title', 'Gallery Management')
@section('header', 'Gallery Management')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <h3 class="text-lg font-semibold text-gray-700">All Images</h3>
    <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-amber-500/20">
        <i data-lucide="plus" class="w-5 h-5 mr-2"></i> Add New Image
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($items as $item)
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group transition-all hover:shadow-xl">
        <div class="relative aspect-square overflow-hidden bg-gray-100">
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->caption }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute bottom-3 right-3 z-10 flex items-center gap-2">
                <a href="{{ route('admin.gallery.edit', $item->id) }}"
                   class="h-9 px-3 rounded-lg bg-white/95 text-slate-800 border border-gray-200 flex items-center justify-center gap-1.5 hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all shadow-md"
                   title="Edit image">
                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                    <span class="text-xs font-semibold">Edit</span>
                </a>
                <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Retire this image from gallery?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="h-9 px-3 rounded-lg bg-white/95 text-red-600 border border-red-200 flex items-center justify-center gap-1.5 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-md"
                            title="Delete image">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span class="text-xs font-semibold">Delete</span>
                    </button>
                </form>
            </div>
            
            @if($item->is_large)
            <div class="absolute top-4 right-4 px-2 py-1 bg-amber-500 text-white text-[10px] font-bold uppercase rounded-md shadow-md">Large Format</div>
            @endif
            
            @if(!$item->is_active)
            <div class="absolute top-4 left-4 px-2 py-1 bg-gray-500 text-white text-[10px] font-bold uppercase rounded-md shadow-md">Inactive</div>
            @endif
        </div>
        <div class="p-4">
            <p class="text-sm font-medium text-gray-800 line-clamp-1 truncate">{{ $item->caption ?? 'No caption' }}</p>
            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">Order: {{ $item->sort_order }}</p>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
        <i data-lucide="image" class="w-16 h-16 mb-4 opacity-20"></i>
        <p class="text-lg">No gallery items found. Start by adding one!</p>
    </div>
    @endforelse
</div>

<div class="mt-12">
    {{ $items->links() }}
</div>
@endsection
