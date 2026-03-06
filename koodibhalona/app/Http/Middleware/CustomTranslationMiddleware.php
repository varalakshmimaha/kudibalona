<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomTranslationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip for admin routes
        if ($request->is('admin') || $request->is('admin/*')) {
            return $response;
        }

        // ── Detect language ──────────────────────────────────
        $lang = $this->detectLanguage($request);

        if ($lang === 'en') {
            return $response;
        }

        // Only process HTML responses
        $contentType = $response->headers->get('Content-Type', '');
        if (strpos($contentType, 'text/html') === false) {
            return $response;
        }

        $content = $response->getContent();
        if (empty($content)) {
            return $response;
        }

        // ── Get translations (w/ Cache) ──────────────────────
        $translations = \Illuminate\Support\Facades\Cache::remember("custom_trans_{$lang}", 3600, function () use ($lang) {
            $data = \App\Models\CustomTranslation::forLanguage($lang);
            if (empty($data)) return [];
            
            // Sort by length descending to match longest phrases first
            uksort($data, function ($a, $b) {
                return mb_strlen($b) - mb_strlen($a);
            });
            return $data;
        });

        if (empty($translations)) {
            return $response;
        }

        // ── Strategy: One pass for text, one for attributes ────
        
        // Prepare patterns for efficient replacement
        // We use placeholders to avoid translating already-translated text
        $placeholders = [];
        $searchKeys = array_keys($translations);
        
        // ── Pass 1: Replace text nodes ────────────────────────
        // This regex matches text between tags, including start/end of string
        // It also captures script/style/title/textarea/option blocks to leave them alone
        $content = preg_replace_callback(
            '/(<(script|style|title|textarea|option)\b[^>]*>.*?<\/\2>)|(^|(?<=>))([^<]+)((?=<)|$)/is',
            function ($matches) use ($translations, &$placeholders) {
                // Return script/style/title/textarea/option blocks unchanged
                if (!empty($matches[1])) {
                    return $matches[1];
                }

                $text = $matches[4];
                if (trim($text) === '') {
                    return $matches[3] . $text . $matches[5];
                }

                $wasModified = false;
                foreach ($translations as $english => $translated) {
                    if (empty($english)) continue;
                    
                    // Use case-insensitive check
                    if (stripos($text, $english) !== false) {
                        $ph = "\x00TR" . count($placeholders) . "\x00";
                        // Wrap in span for frontend protection
                        $placeholders[$ph] = '<span class="notranslate">' . $translated . '</span>';
                        $text = str_ireplace($english, $ph, $text);
                        $wasModified = true;
                    }
                }

                return $matches[3] . $text . $matches[5];
            },
            $content
        );

        // Fill in placeholders
        if (!empty($placeholders)) {
            $content = strtr($content, $placeholders);
        }

        // ── Pass 2: Handle <title>, <textarea>, <option> and attributes (no spans here) ──
        $content = preg_replace_callback(
            '/(<(title|textarea|option)\b[^>]*>)(.*?)(<\/\2>)|\b(alt|placeholder|title|aria-label)="([^"]*?)"/is',
            function ($matches) use ($translations) {
                // If it's a <title>, <textarea>, or <option> tag
                if (!empty($matches[1])) {
                    $openTag = $matches[1];
                    $text = $matches[3];
                    $closeTag = $matches[4];
                    foreach ($translations as $english => $translated) {
                        $text = str_ireplace($english, $translated, $text);
                    }
                    return $openTag . $text . $closeTag;
                }
                
                // If it's an attribute
                $attr = $matches[5];
                $val  = $matches[6];
                foreach ($translations as $english => $translated) {
                    $val = str_ireplace($english, $translated, $val);
                }
                return $attr . '="' . $val . '"';
            },
            $content
        );

        // ── Pass 3: Brand name corrections (Kannada specific) ──
        if ($lang === 'kn') {
            $correct = 'ಕೂಡಿಬಾಳೋಣ';
            $wrongPatterns = [
                'ಕೂಡಿಭಲೋನಾ', 'ಕೂಡಿಭಲೋನ', 'ಕೂಡಿಬಲೋನಾ', 'ಕೂಡಿಬಲೋನ',
                'ಕೂಡಿಬಲೊನ', 'ಕೂಡಿಬಾಲೋಣ', 'ಕೂಡಿಬಾಲೋನ', 'ಕೂಡಿಭಾಲೋನ',
                'ಕೂಡಿಭಾಳೋಣ', 'ಕೂಡಿಭಾಳೋನ'
            ];
            $content = str_replace($wrongPatterns, $correct, $content);
            $content = preg_replace('/ಕೂಡಿ[ಭಬ][ಾ]?ಲ[ೋೊ][ನಣ][ಾ]?/u', $correct, $content);
        }

        $response->setContent($content);
        return $response;
    }

    private function detectLanguage(Request $request): string
    {
        // 1. site_lang cookie
        $siteLang = $_COOKIE['site_lang'] ?? null;
        if ($siteLang && in_array($siteLang, ['en', 'kn', 'te', 'hi', 'ta'])) {
            return $siteLang;
        }

        // 2. googtrans cookie
        if (isset($_COOKIE['googtrans'])) {
            $parts = explode('/', trim($_COOKIE['googtrans'], '/'));
            $gtLang = end($parts);
            if (in_array($gtLang, ['en', 'kn', 'te', 'hi', 'ta'])) {
                return $gtLang;
            }
        }

        return 'en';
    }

}


