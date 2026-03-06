<?php
namespace App\Http\Controllers;

use App\Models\{HeroSlide, AboutSection, Objective, Service, GalleryItem, Plan, ContactInfo, SiteSetting, ContactMessage};
use Illuminate\Http\Request;

class PageController extends Controller {
    public function home() {
        $slides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get();

        // If no slides configured, build one from banner_1 settings
        if ($slides->isEmpty()) {
            $slides = collect([(object)[
                'image'       => SiteSetting::get('home_page_banner') ?: SiteSetting::get('banner_1_image'),
                'label'       => SiteSetting::get('banner_1_title', 'Welcome to Koodibhalona Trust (R)'),
                'title'       => SiteSetting::get('banner_1_subtitle', 'Serving Humanity with Compassion & Purpose'),
                'subtitle'    => null,
                'button_text' => SiteSetting::get('banner_1_btn_text', 'About Us'),
                'button_link' => SiteSetting::get('banner_1_btn_link', route('about')),
            ]]);
        }

        $services = Service::where('is_active', true)->orderBy('sort_order')->limit(6)->get();
        return view('home', compact('slides', 'services'));
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

    private function toYoutubeEmbedUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $url = trim($url);
        if ($url === '') {
            return null;
        }

        if (!preg_match('~^https?://~i', $url)) {
            $url = 'https://' . ltrim($url, '/');
        }

        $parts = parse_url($url);
        if ($parts === false) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = trim($parts['path'] ?? '', '/');
        parse_str($parts['query'] ?? '', $query);

        if (isset($query['list']) && !isset($query['v'])) {
            return 'https://www.youtube.com/embed/videoseries?list=' . $query['list'];
        }

        if (isset($query['v']) && $query['v'] !== '') {
            return 'https://www.youtube.com/embed/' . $query['v'];
        }

        if (str_contains($host, 'youtu.be')) {
            $videoId = explode('/', $path)[0] ?? '';
            return $videoId !== '' ? 'https://www.youtube.com/embed/' . $videoId : null;
        }

        if (preg_match('~^embed/([^/?#]+)~', $path, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        if (preg_match('~^(shorts|live)/([^/?#]+)~', $path, $m)) {
            return 'https://www.youtube.com/embed/' . $m[2];
        }

        return null;
    }
}
