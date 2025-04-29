<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

class CartService
{
    /**
     * Lấy giỏ hàng của người dùng hiện tại.
     */
    public function getUserCart($userId)
    {
        return Cart::with([
            'items' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Sắp xếp theo thời gian tạo, giảm dần
            },
            'items.document'
        ])
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Thêm hoặc cập nhật sản phẩm trong giỏ hàng.
     */
    public function addItemToCart($userId, $documentId, $quantity)
    {
        // Tìm hoặc tạo giỏ hàng
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Thêm hoặc cập nhật sản phẩm trong giỏ hàng
        $cartItem = $cart->items()->updateOrCreate(
            ['document_id' => $documentId],
            [
                'quantity' => $quantity,
            ]
        );

        // Load document cho item vừa thêm
        $cartItem->load('document');

        return $cartItem;
    }


    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function removeItemFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();
        return true;
    }
}
