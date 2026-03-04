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

        // ── Detect language ──────────────────────────────────
        // Priority: site_lang cookie > googtrans cookie > default (en)
        $lang = null;

        // 1. site_lang cookie (set by our JS)
        $siteLangCookie = $_COOKIE['site_lang'] ?? null;
        if ($siteLangCookie && in_array($siteLangCookie, ['en', 'kn', 'te', 'hi', 'ta'])) {
            $lang = $siteLangCookie;
        }

        // 2. Fallback: googtrans cookie (set by Google Translate)
        if (!$lang && isset($_COOKIE['googtrans'])) {
            $parts = array_values(array_filter(explode('/', trim($_COOKIE['googtrans'], '/'))));
            $gtLang = $parts[count($parts) - 1] ?? 'en';
            if (in_array($gtLang, ['en', 'kn', 'te', 'hi', 'ta'])) {
                $lang = $gtLang;
            }
        }

        $lang = $lang ?: 'en';

        if ($lang === 'en') {
            return $response;
        }

        $contentType = $response->headers->get('Content-Type', '');
        if (strpos($contentType, 'text/html') === false) {
            return $response;
        }

        $content = $response->getContent();
        if (empty($content)) {
            return $response;
        }

        $translations = \App\Models\CustomTranslation::forLanguage($lang);
        if (empty($translations)) {
            return $response;
        }

        // Sort translations by length descending — longest phrases matched first
        uksort($translations, function ($a, $b) {
            return mb_strlen($b) - mb_strlen($a);
        });

        // ── Pass 1: Replace text nodes (between tags) ──────────────────────────
        // Skips <script>, <style>, <title> blocks entirely.
        $content = preg_replace_callback(
            '/(<script\b[^>]*>.*?<\/script>|<style\b[^>]*>.*?<\/style>|<title\b[^>]*>.*?<\/title>)|>([^<]+)</is',
            function ($matches) use ($translations) {
                // Return script/style blocks unchanged
                if (!empty($matches[1])) {
                    return $matches[0];
                }

                $text = $matches[2];

                if (trim($text) === '') {
                    return $matches[0];
                }

                $modified    = false;
                $placeholders = [];
                $i = 0;

                foreach ($translations as $english => $translated) {
                    if (empty($english) || empty($translated)) {
                        continue;
                    }
                    if (stripos($text, $english) !== false) {
                        $ph = "\x00TR{$i}\x00";
                        // Wrap translated text in notranslate span so Google Translate ignores it
                        $placeholders[$ph] = '<span class="notranslate">' . $translated . '</span>';
                        $text = str_ireplace($english, $ph, $text);
                        $modified = true;
                        $i++;
                    }
                }

                if ($modified) {
                    $text = strtr($text, $placeholders);
                    return '>' . $text . '<';
                }

                return $matches[0];
            },
            $content
        );

        // ── Pass 2: Replace inside <title> ────────────────────────────────────
        $content = preg_replace_callback(
            '/(<title\b[^>]*>)(.*?)(<\/title>)/is',
            function ($matches) use ($translations) {
                $text = $matches[2];
                foreach ($translations as $english => $translated) {
                    if (empty($english) || empty($translated)) continue;
                    $text = str_ireplace($english, $translated, $text);
                }
                return $matches[1] . $text . $matches[3];
            },
            $content
        );

        // ── Pass 3: Replace inside HTML attributes (alt, placeholder, title, value, aria-label) ─
        $content = preg_replace_callback(
            '/\b(alt|placeholder|title|value|aria-label)="([^"]*?)"/i',
            function ($matches) use ($translations) {
                $attr = $matches[1];
                $text = $matches[2];
                foreach ($translations as $english => $translated) {
                    if (empty($english) || empty($translated)) continue;
                    $text = str_ireplace($english, $translated, $text);
                }
                return $attr . '="' . $text . '"';
            },
            $content
        );

        // ── Pass 4: Correct any wrong Kannada brand-name produced by Google Translate ──
        if ($lang === 'kn') {
            $wrong_variants = [
                'ಕೂಡಿಭಲೋನಾ', 'ಕೂಡಿಭಲೋನ', 'ಕೂಡಿಬಲೋನಾ', 'ಕೂಡಿಬಲೋನ',
                'ಕೂಡಿಬಲೊನ', 'ಕೂಡಿಬಾಲೋಣ', 'ಕೂಡಿಬಾಲೋನ', 'ಕೂಡಿಭಾಲೋನ',
                'ಕೂಡಿಭಾಳೋಣ', 'ಕೂಡಿಭಾಳೋನ',
            ];
            $correct = 'ಕೂಡಿಬಾಳೋಣ';
            foreach ($wrong_variants as $wrong) {
                $content = str_replace($wrong, $correct, $content);
            }
            // Regex for any remaining close variants
            $content = preg_replace('/ಕೂಡಿ[ಭಬ][ಾ]?ಲ[ೋೊ][ನಣ][ಾ]?/u', $correct, $content);
        }

        $response->setContent($content);
        return $response;
    }
}
