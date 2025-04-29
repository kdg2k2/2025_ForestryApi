<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [];
    /**
     * Quan hệ với Cart (một item thuộc về một giỏ hàng).
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Quan hệ với Document (một item liên kết với một sản phẩm).
     */
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
