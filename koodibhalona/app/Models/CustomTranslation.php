<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTranslation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'english_word', 
        'kannada_word', 
        'telugu_word', 
        'hindi_word', 
        'tamil_word', 
        'category',
        'description',
        'is_hidden'
    ];

    // Language code → column name mapping
    public static $languages = [
        'en' => ['label' => 'English',  'flag' => '🇬🇧', 'column' => 'english_word'],
        'kn' => ['label' => 'ಕನ್ನಡ',   'flag' => '🇮🇳', 'column' => 'kannada_word'],
        'te' => ['label' => 'తెలుగు',  'flag' => '🇮🇳', 'column' => 'telugu_word'],
        'hi' => ['label' => 'हिन्दी',   'flag' => '🇮🇳', 'column' => 'hindi_word'],
        'ta' => ['label' => 'தமிழ்',   'flag' => '🇮🇳', 'column' => 'tamil_word'],
    ];

    // Get all active translations for a given language code as [english => translated]
    public static function forLanguage(string $lang): array
    {
        $col = static::$languages[$lang]['column'] ?? null;
        if (!$col || $lang === 'en') return [];

        return static::where('is_hidden', false)
            ->whereNotNull($col)
            ->where($col, '!=', '')
            ->pluck($col, 'english_word')
            ->toArray();
    }
}
