<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function orderDocument()
    {
        return $this->hasMany(OrderDocument::class, 'id_order');
    }

    public function orderUserRole()
    {
        return $this->hasMany(OrderUserRole::class, 'id_order');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_order');
    }
}
