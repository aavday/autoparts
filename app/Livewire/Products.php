<?php

namespace App\Livewire;

use App\Actions\GetCartItemsAction;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Products extends Component
{
    public Collection $products;
    public Collection $categories;
    public Authenticatable|User $user;
    public array $cart = [];
    public int|null $categoryId = null;
    public string $sortColumn = 'id';
    public string $sortDirection = 'asc';

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->categories = Category::all();
    }

    public function render(): Application|Factory|View
    {
        $this->products = Product::query()
            ->withAggregate('category', 'name')
            ->with('category')
            ->when($this->categoryId, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->get();
        $this->cart = GetCartItemsAction::execute($this->user->toArray()['cart']);
        return view('products');
    }

    public function setFilterCategory(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function addToCart(int $productId): void
    {
        $cart = $this->user->cart;

        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }

        $this->user->cart = $cart;
        $this->user->save();
    }
}
