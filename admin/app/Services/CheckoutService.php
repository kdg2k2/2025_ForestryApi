<?php

namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\OrderDocumentRepository;
use Illuminate\Support\Facades\Log;

class CheckoutService
{
    protected $orderDocumentRepository;
    protected $vnpayService;
    protected $cartItemRepository;

    public function __construct()
    {
        $this->orderDocumentRepository = app(OrderDocumentRepository::class);
        $this->vnpayService = app(VnpayService::class);
        $this->cartItemRepository = app(CartItemRepository::class);
    }
    public function checkout(int $cartId, array $request)
    {
        $cartItems = $this->cartItemRepository->getCartItems($cartId, $request['cart_ids']);
        Log::info('Cart items:', ['cartItems' => $cartItems]);
        $totalPrice = array_reduce($cartItems->toArray(), function ($carry, $item) {
            return $carry + ($item['document'] ? $item['document']['price'] : 0);
        }, 0);
        $orderCode = $this->generateRandomCode();
        //  Create order
        $res = $this->vnpayService->createPaymentUrl([
            'order_code' => $orderCode,
            'total' => $totalPrice,
            'info' => 'Thanh toán đơn hàng ' . $orderCode,
            'type' => 'billpayment',
            'return_url' => route('admin.document.vnpay-return'),
        ]);

        $orderDocument = [];
        foreach ($cartItems as $item) {
            if ($item->document_id) {
                $orderDocument[] = [
                    "id_order" => $res['order']['id'],
                    "id_document" => $item->document_id,
                    "price" => $item->document->price,
                    "quantity" => $item->quantity,
                ];
            }
        }
        // Create order document
        $this->orderDocumentRepository->insetMany($orderDocument);
        // Delete cart items
        $this->cartItemRepository->deleteCartItems($cartId, $request['cart_ids']);
        return $res['url'];
    }

    protected function generateRandomCode($length = 16)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomCode;
    }
}
