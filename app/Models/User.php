<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'id_role');
    }

    public function unit()
    {
        return $this->belongsTo(UserUnit::class, 'id_unit');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'id_uploader');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_user');
    }

    public function viewDocumentLog()
    {
        return $this->hasMany(DocumentViewLog::class, 'id_user');
    }
  
      public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
