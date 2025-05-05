<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
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
