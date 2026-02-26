<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller {
    public function index() {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create() {
        return view('admin.services.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|max:2048',
            'sub_links' => 'nullable|array',
            'sub_links.*' => 'nullable|string',
            'sort_order' => 'required|integer',
        ]);

        $service = new Service();
        $service->title = $request->title;
        $service->tag = $request->tag;
        $service->description = $request->description;
        $service->sort_order = $request->sort_order;
        $service->is_active = $request->has('is_active');
        $service->sub_links = array_filter($request->input('sub_links', []));

        if ($request->hasFile('image_file')) {
            $service->image = $request->file('image_file')->store('services', 'public');
        }

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service) {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service) {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'description' => 'required|string',
            'image_file' => 'nullable|image|max:2048',
            'sub_links' => 'nullable|array',
            'sub_links.*' => 'nullable|string',
            'sort_order' => 'required|integer',
        ]);

        $service->title = $request->title;
        $service->tag = $request->tag;
        $service->description = $request->description;
        $service->sort_order = $request->sort_order;
        $service->is_active = $request->has('is_active');
        $service->sub_links = array_filter($request->input('sub_links', []));

        if ($request->hasFile('image_file')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $service->image = $request->file('image_file')->store('services', 'public');
        }

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service) {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return back()->with('success', 'Service deleted successfully.');
    }
}
