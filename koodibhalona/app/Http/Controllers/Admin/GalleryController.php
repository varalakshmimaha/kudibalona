<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(12);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'caption' => 'nullable|string|max:255',
            'is_large' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        GalleryItem::create([
            'image' => $imagePath,
            'caption' => $request->caption,
            'is_large' => $request->has('is_large'),
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added to gallery successfully.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.edit', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'caption' => 'nullable|string|max:255',
            'is_large' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = [
            'caption' => $request->caption,
            'is_large' => $request->has('is_large'),
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image removed from gallery.');
    }
}
