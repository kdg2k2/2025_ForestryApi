<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $guarded = [];
    /**
     * Quan hệ với User (một giỏ hàng thuộc về một người dùng).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với CartItem (một giỏ hàng có nhiều item).
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
