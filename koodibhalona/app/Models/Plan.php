<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model {
    protected $fillable = ['name','icon','price','period','description','features','color','is_featured','sort_order','is_active'];
    protected $casts = ['features' => 'array', 'is_featured' => 'boolean', 'is_active' => 'boolean', 'price' => 'decimal:2'];
}
