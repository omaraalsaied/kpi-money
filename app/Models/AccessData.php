<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessData extends Model
{
    use HasFactory;
    public $guarded = [];
    protected $fillable = ['accountId', 'accessToken', 'clientId', 'createAt', 'removeAt', 'u_agent', 'ip_addr'];
    public function scopeSelection($query)
    {
        return $query->select('id', 'accountId', 'accessToken', 'clientId', 'createAt', 'removeAt', 'u_agent', 'ip_addr');
    }
}
