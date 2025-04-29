<?php

namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository
{
    public function getCartItems($cartId, array $cartIds = [])
    {
        return CartItem::where('cart_id', $cartId)
            ->with('document')
            ->when($cartIds, function ($query) use ($cartIds) {
                return $query->whereIn('id', $cartIds);
            })
            ->get();
    }

    public function deleteCartItems($cartId, array $cartIds = [])
    {
        return CartItem::where('cart_id', $cartId)
            ->when($cartIds, function ($query) use ($cartIds) {
                return $query->whereIn('id', $cartIds);
            })
            ->delete();
    }
}
