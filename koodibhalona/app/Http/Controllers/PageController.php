<?php
namespace App\Http\Controllers;

use App\Models\{HeroSlide, AboutSection, Objective, Service, GalleryItem, Plan, ContactInfo, SiteSetting, ContactMessage};
use Illuminate\Http\Request;

class PageController extends Controller {
    public function home() {
        $slides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get();
        $about = AboutSection::first();
        $objective = Objective::first();
        $services = Service::where('is_active', true)->orderBy('sort_order')->limit(6)->get();
        return view('home', compact('slides', 'about', 'services', 'objective'));
    }

    public function about() {
        $about = AboutSection::first();
        $objective = Objective::first();
        $teamMembers = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();
        return view('about', compact('about', 'objective', 'teamMembers'));
    }

    public function services() {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('services', compact('services'));
    }



    public function gallery() {
        $items = GalleryItem::where('is_active', true)->orderBy('created_at', 'desc')->get();
        return view('gallery', compact('items'));
    }

    public function contact() {
        $info = ContactInfo::first();
        return view('contact', compact('info'));
    }

    public function contactSubmit(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
