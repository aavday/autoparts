<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Products extends Component
{
    public Collection $products;
    public Collection $categories;
    public int|null $categoryId = null;
    public string $sortColumn = 'id';
    public string $sortDirection = 'asc';

    public function mount(): void
    {
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
        return view('livewire.products');
    }

    public function setFilterCategory(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function addToCart(int $productId): void
    {
        Product::query()->find($productId)->decrement('quantity');
    }
}
