<?php
namespace App\Http\Controllers;

use App\Models\{HeroSlide, AboutSection, Objective, Service, GalleryItem, Plan, ContactInfo, SiteSetting, ContactMessage, CustomTranslation};
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function dashboard() {
        $stats = [
            'messages' => ContactMessage::count(),
            'services' => Service::count(),
            'slides' => HeroSlide::count(),
            'plans' => Plan::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function messages() {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages', compact('messages'));
    }

    public function settings() {
        $settings = [
            'site_name' => SiteSetting::get('site_name'),
            'site_tagline' => SiteSetting::get('site_tagline'),
            'footer_text' => SiteSetting::get('footer_text'),
            'quote_text' => SiteSetting::get('quote_text'),
            'footer_about' => SiteSetting::get('footer_about'),
            'site_logo' => SiteSetting::get('site_logo'),
            'home_banner_image' => SiteSetting::get('home_banner_image'),
        ];
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request) {
        // ... previous settings logic (I'll keep it)
        $siteKeys = ['site_name', 'site_tagline', 'footer_text', 'quote_text', 'footer_about'];
        foreach ($siteKeys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('site', 'public');
            SiteSetting::set('site_logo', $logoPath);
        }
        if ($request->hasFile('home_banner_image')) {
            $homeBannerPath = $request->file('home_banner_image')->store('site', 'public');
            SiteSetting::set('home_banner_image', $homeBannerPath);
        }

        $contact = ContactInfo::first();
        if ($contact) {
            $contactKeys = ['address', 'email', 'phone', 'phone2', 'facebook', 'instagram', 'youtube', 'whatsapp'];
            $contactData = [];
            foreach ($contactKeys as $key) {
                if ($request->has($key)) {
                    $contactData[$key] = $request->input($key);
                }
            }
            if (!empty($contactData)) {
                $contact->update($contactData);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function about() {
        $settings = [
            'about_santana_kannada' => SiteSetting::get('about_santana_kannada'),
            'about_santana_desc1' => SiteSetting::get('about_santana_desc1'),
            'about_santana_desc2' => SiteSetting::get('about_santana_desc2'),
            'about_santana_image' => SiteSetting::get('about_santana_image'),
            'about_banner_image' => SiteSetting::get('about_banner_image'),
            'about_founder_intro' => SiteSetting::get('about_founder_intro'),
            'about_founder_photo1' => SiteSetting::get('about_founder_photo1'),
            'about_founder_photo2' => SiteSetting::get('about_founder_photo2'),
            'about_founder_quote' => SiteSetting::get('about_founder_quote'),
            'about_founder_quote_desc' => SiteSetting::get('about_founder_quote_desc'),
            'about_vision' => SiteSetting::get('about_vision'),
            'about_mission' => SiteSetting::get('about_mission'),
        ];
        return view('admin.about', compact('settings'));
    }

    public function aboutUpdate(Request $request) {
        $textKeys = [
            'about_santana_kannada', 'about_santana_desc1', 'about_santana_desc2', 
            'about_founder_intro', 'about_founder_quote', 'about_founder_quote_desc',
            'about_vision', 'about_mission'
        ];
        
        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        $imageKeys = ['about_banner_image', 'about_santana_image', 'about_founder_photo1', 'about_founder_photo2'];
        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('about', 'public');
                SiteSetting::set($key, $path);
            }
        }

        return back()->with('success', 'About Us page updated successfully.');
    }

    public function translations() {
        $translations = CustomTranslation::orderBy('category')->orderBy('english_word')->get();
        $languages = \App\Models\CustomTranslation::$languages;
        $categories = CustomTranslation::distinct()->pluck('category')->filter()->values();
        return view('admin.translations', compact('translations', 'languages', 'categories'));
    }

    public function translationsStore(Request $request) {
        $data = $request->validate([
            'english_word'  => 'required|string|max:500',
            'kannada_word'  => 'nullable|string|max:500',
            'telugu_word'   => 'nullable|string|max:500',
            'hindi_word'    => 'nullable|string|max:500',
            'tamil_word'    => 'nullable|string|max:500',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string|max:500',
        ]);

        if (empty($data['category'])) $data['category'] = 'general';
        CustomTranslation::create($data);
        return back()->with('success', 'Translation keyword added successfully.');
    }

    public function translationsUpdate(Request $request, $id) {
        $data = $request->validate([
            'english_word'  => 'required|string|max:500',
            'kannada_word'  => 'nullable|string|max:500',
            'telugu_word'   => 'nullable|string|max:500',
            'hindi_word'    => 'nullable|string|max:500',
            'tamil_word'    => 'nullable|string|max:500',
            'category'      => 'nullable|string|max:100',
            'description'   => 'nullable|string|max:500',
        ]);

        if (empty($data['category'])) $data['category'] = 'general';
        CustomTranslation::findOrFail($id)->update($data);
        return back()->with('success', 'Translation keyword updated successfully.');
    }

    public function translationsToggle($id) {
        $translation = CustomTranslation::findOrFail($id);
        $translation->is_hidden = !$translation->is_hidden;
        $translation->save();
        $msg = $translation->is_hidden ? 'Keyword hidden.' : 'Keyword activated.';
        return back()->with('success', $msg);
    }

    public function translationsDestroy($id) {
        CustomTranslation::findOrFail($id)->delete();
        return back()->with('success', 'Translation keyword removed.');
    }

    public function objectives() {
        $objective = Objective::first();
        return view('admin.objectives', compact('objective'));
    }

    public function objectivesUpdate(Request $request) {
        $objective = Objective::first();
        if (!$objective) $objective = new Objective();

        $data = $request->validate([
            'youtube_url' => 'nullable|string',
            'list_items' => 'required|array',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('objectives', 'public');
        }

        $objective->fill($data);
        $objective->save();

        return back()->with('success', 'Objectives updated successfully.');
    }
}

