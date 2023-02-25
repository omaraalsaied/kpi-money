<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $guarded = [];
    protected $table='admins';
    protected $fillable = ['username', 'salt', 'password', 'fullname', 'createAt', 'u_agent', 'ip_addr'];
    protected $hidden = ['password'];
    public function scopeSelection($query)
    {
        return $query->select('id', 'username', 'salt', 'password', 'fullname', 'createAt', 'u_agent', 'ip_addr');
    }
}
