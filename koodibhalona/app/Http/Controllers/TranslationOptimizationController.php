<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationOptimizationController extends Controller {
    /**
     * Get cached translations with HTTP caching headers
     * Reduces redundant Google Translate API calls
     */
    public function getCachedTranslations(Request $request) {
        $lang = $request->query('lang', 'en');
        
        if (!in_array($lang, ['en', 'kn', 'hi', 'te', 'ta'])) {
            $lang = 'en';
        }

        // Cache translations for 24 hours
        $cacheKey = "translations.{$lang}";
        $translations = Cache::remember($cacheKey, 86400, function() use ($lang) {
            return \App\Models\CustomTranslation::forLanguage($lang)->get();
        });

        return response()->json($translations)
            ->header('Cache-Control', 'public, max-age=86400')
            ->header('ETag', md5(json_encode($translations)));
    }

    /**
     * Clear translation cache when admin updates translations
     */
    public static function clearTranslationCache() {
        foreach (['en', 'kn', 'hi', 'te', 'ta'] as $lang) {
            Cache::forget("translations.{$lang}");
        }
    }

    /**
     * Preload translations on app bootstrap
     * Reduces time to first translation
     */
    public static function preloadTranslations() {
        if (app()->environment('production')) {
            foreach (['kn', 'hi', 'te', 'ta'] as $lang) {
                $cacheKey = "translations.{$lang}";
                if (!Cache::has($cacheKey)) {
                    Cache::remember($cacheKey, 86400, function() use ($lang) {
                        return \App\Models\CustomTranslation::forLanguage($lang)->get();
                    });
                }
            }
        }
    }
}
