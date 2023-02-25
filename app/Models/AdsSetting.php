<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class AdsSetting extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['admob_pub_id', 'admob_app_id', 'admob_bads_id', 'admob_iads_id', 'admob_rads_id', 'facebook_app_id', 'facebook_bads_p_id', 'facebook_rads_p_id', 'user_id', 'active'];
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
        return $query->select('id', 'admob_pub_id', 'admob_app_id', 'admob_bads_id', 'admob_iads_id', 'admob_rads_id', 'facebook_app_id', 'facebook_bads_p_id', 'facebook_rads_p_id', 'user_id', 'active');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
