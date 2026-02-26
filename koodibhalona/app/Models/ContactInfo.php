<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model {
    protected $fillable = ['email','phone','phone2','address','facebook','instagram','youtube','whatsapp','maps_embed'];
}
