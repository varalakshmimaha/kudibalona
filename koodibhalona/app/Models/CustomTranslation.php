<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTranslation extends Model
{
    use HasFactory;
    
    protected $fillable = ['english_word', 'kannada_word', 'is_hidden'];
    //
}
