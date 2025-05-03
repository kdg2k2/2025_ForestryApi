<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\CartRepository;

class CartService extends BaseService
{
    protected $cartRepository;
    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
    }

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
            ->where('id_user', $userId)
            ->first();
    }

    /**
     * Thêm hoặc cập nhật sản phẩm trong giỏ hàng.
     */
    public function addItemToCart($userId, $documentId, $quantity)
    {
        // Tìm hoặc tạo giỏ hàng
        $cart = Cart::firstOrCreate(['id_user' => $userId]);

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

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->cartRepository->store($request);
        });
    }
}
