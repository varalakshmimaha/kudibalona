<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model {
    protected $fillable = ['image','youtube_url','list_items'];
    protected $casts = ['list_items' => 'array'];
}
