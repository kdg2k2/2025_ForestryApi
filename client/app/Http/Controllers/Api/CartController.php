<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CreateRequest;
use App\Http\Requests\Cart\DeleteRequest;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct()
    {
        $this->cartService = app(CartService::class);
    }

    public function index()
    {
        $cart = $this->cartService->getUserCart(auth()->id());
        return response()->json([
            'data' => $cart,
        ]);
    }

    public function addItem(CreateRequest $request)
    {
        $cartItem = $this->cartService->addItemToCart(
            auth()->id(),
            $request->document_id,
            $request->quantity,
        );

        return response()->json([
            'message' => 'Thêm giỏ hàng thành công!',
            'data' => $cartItem,
        ]);
    }

    public function deleteItem(DeleteRequest $req)
    {
        $this->cartService->removeItemFromCart($req->id);
        return response()->json([
            'message' => 'Xóa giỏ hàng thành công!',
        ]);
    }
}
