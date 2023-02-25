<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class WebSiteLink extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['title', 'site_url', 'code_number', 'reward', 'user_id', 'active'];
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('active', 0);
    }
    public function getActive()
    {
        return $this->active == 1 ? Lang::get('site.active') : Lang::get('site.inactive');
    }
    public function scopeSelection($query)
    {
        return $query->select('id', 'title', 'site_url', 'code_number', 'reward', 'user_id', 'active');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
