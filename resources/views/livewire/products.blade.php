<div class="bg-gray-50">
    <div class="relative min-h-screen flex flex-col">
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <main class="mt-6">
                <div class="flex items-center">
                    <div class="pr-6">
                        <div>
                            <b>Filter by category:</b>
                        </div>
                        <select name="categoryFilter" id="categoryFilter" wire:model.live="categoryId" class="select">
                            <option value="0" selected>All</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pr-6">
                        <div>
                            <b>Order by column:</b>
                        </div>
                        <select name="sortColumn" id="sortColumn" wire:model.live="sortColumn" class="select">
                            <option value="id" selected>Standard</option>
                            <option value="name">Name</option>
                            <option value="category_name">Category name</option>
                            <option value="price">Price</option>
                        </select>
                    </div>
                    <div class="pr-6">
                        <div>
                            <b>Order by direction:</b>
                        </div>
                        <select name="sortDirection" id="sortDirection" wire:model.live="sortDirection" class="select">
                            <option value="asc" selected>Ascendant</option>
                            <option value="desc">Descendant</option>
                        </select>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Description</td>
                            <td>Add to cart</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="plus">
                                <button type="button" wire:click="addToCart({{ $product->id }})">+</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</div>
