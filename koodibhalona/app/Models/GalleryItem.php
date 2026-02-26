<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model {
    protected $fillable = ['image','caption','is_large','sort_order','is_active'];
    protected $casts = ['is_large' => 'boolean', 'is_active' => 'boolean'];
}
