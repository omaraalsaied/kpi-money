<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Offerwall extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['name', 'subtitle', 'url', 'points', 'image', 'type', 'featured', 'position', 'status',];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('status', 0);
    }
    public function getActive()
    {
        return $this->status == 1 ? Lang::get('site.active') : Lang::get('site.inactive');
    }
    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'subtitle', 'url', 'points', 'image', 'type', 'featured', 'position', 'status',);
    }
}
