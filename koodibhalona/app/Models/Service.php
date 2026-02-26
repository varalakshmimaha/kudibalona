<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {
    protected $fillable = ['image','tag','title','description','sub_links','sort_order','is_active'];
    protected $casts = ['sub_links' => 'array', 'is_active' => 'boolean'];
}
