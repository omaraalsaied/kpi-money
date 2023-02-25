<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $guarded = [];
    protected $fillable = [ 'last_access', 'last_ip_addr', 'gcm_regid', 'state', 'fullname', 'salt', 'passw', 'login', 'email', 'image', 'regtime', 'regtype', 'ip_addr', 'mobile', 'points', 'refer', 'refered', 'referer', 'status'];
    protected $hidden = ['passw'];
    //protected $casts = ['email_verified_at' => 'datetime',];
    public function scopeSelection($query){
        return $query->select('id','last_access', 'last_ip_addr', 'gcm_regid', 'state', 'fullname', 'salt', 'passw', 'login', 'email', 'image', 'regtime', 'regtype', 'ip_addr', 'mobile', 'points', 'refer', 'refered', 'referer', 'status');
    }
        public function userpoint()
    {
        return $this->belongsTo(UserPoint::class);
    }

}
