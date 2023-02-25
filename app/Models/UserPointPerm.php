<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPointPerm extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['user_id','point_id','times',];
    public function scopeSelection($query)
    {
        return $query->select('id', 'user_id','user_id','point_id','times');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function point(){
        return $this->belongsTo(Point::class,'point_id');
    }
}
