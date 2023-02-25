<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPointOffer extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['user_id', 'offerwall_id', 'earn', 'created_at', 'updated_at',];
    public function scopeSelection($query)
    {
        return $query->select('id', 'user_id', 'offerwall_id', 'earn', 'created_at', 'updated_at',);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function offerwall()
    {
        return $this->belongsTo(Offerwall::class, 'offerwall_id');
    }
}
