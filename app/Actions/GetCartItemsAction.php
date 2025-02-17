<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Notifications\Action;

class GetCartItemsAction extends Action
{
    public static function execute(array|null $cartItems): array
    {
        if (!$cartItems) return [];
        $cart = [];

        foreach ($cartItems as $id => $quantity) {
            $product = Product::query()->find($id);

            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        return $cart;
    }
}
