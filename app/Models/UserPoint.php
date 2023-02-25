<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['user_id', 'link_id', 'earn', 'created_at', 'updated_at',];
    public function scopeSelection($query)
    {
        return $query->select('id', 'user_id', 'link_id', 'earn', 'created_at', 'updated_at',);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function link()
    {
        return $this->belongsTo(WebSiteLink::class, 'link_id');
    }
}
