<?php

namespace App\Livewire;

use App\Actions\GetCartItemsAction;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public Authenticatable|User $user;
    public array $cart = [];
    public int $totalAmount = 0;
    public string $userName = '';
    public string $userEmail = '';
    public string $userPhone = '';
    public string $userAddress = '';
    public string $error = '';

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->userName = $this->user->name ?: '';
        $this->userEmail = $this->user->email ?: '';
        $this->userPhone = $this->user->phone ?: '';
        $this->userAddress = $this->user->address ?: '';
    }

    public function render(): Application|Factory|View
    {
        $this->cart = GetCartItemsAction::execute($this->user['cart']);
        $this->totalAmount = $this->countTotalAmount($this->cart);
        return view('cart');
    }

    public function removeFromCart(int $productId): void
    {
        $cart = $this->user->cart;

        if (isset($cart[$productId])) {
            if ($cart[$productId] === 1) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]--;
            }
        }

        $this->user->cart = $cart;
        $this->user->save();
    }

    public function countTotalAmount(array $cart): int
    {
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        return $totalAmount;
    }

    public function saveOrder(): bool
    {
        if (!$this->cart) {
            $this->error = 'No items in the cart';
            return false;
        }
        $totalAmount = 0;

        foreach ($this->cart as $productId => $item) {
            $product = Product::query()->find($productId);
            if (!$product || $product->quantity < $item['quantity']) {
                $this->error = 'Some of the items are out of stock';
                return false;
            }

            $totalAmount += $product->price * $item['quantity'];
        }

        DB::transaction(function () use ($totalAmount) {
            $order = Order::query()->create([
                'user_id' => $this->user->id,
                'total_amount' => $totalAmount,
                'shipment_address' => $this->userAddress
            ]);

            foreach ($this->cart as $productId => $item) {
                OrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity']
                ]);
            }
        });

        $this->user->name = $this->userName;
        $this->user->email = $this->userEmail;
        $this->user->phone = $this->userPhone;
        $this->user->address = $this->userAddress;
        $this->user->cart = null;
        $this->user->save();

        return true;
    }
}
