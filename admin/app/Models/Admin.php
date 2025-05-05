<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = "admins";
    protected $guarded = [];
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_uploader');
    }

    public function unit()
    {
        return $this->belongsTo(UserUnit::class, 'id_unit');
    }
}
