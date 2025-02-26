
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="relative min-h-screen flex flex-col py-12">
        <main class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center">
                <div class="pr-6">
                    <div class="text-gray-900 mb-1">
                        Filter by category:
                    </div>
                    <select name="categoryFilter" id="categoryFilter" wire:model.live="categoryId" class="select cursor-pointer text-gray-900 rounded shadow ring-black ring-opacity-5 ring-1 border-none">
                        <option value="0" selected>All</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="pr-6">
                    <div class="text-gray-900 mb-1">
                        Order by column:
                    </div>
                    <select name="sortColumn" id="sortColumn" wire:model.live="sortColumn" class="select cursor-pointer text-gray-900 rounded shadow ring-black ring-opacity-5 ring-1 border-none">
                        <option value="id" selected>Standard</option>
                        <option value="name">Name</option>
                        <option value="category_name">Category name</option>
                        <option value="price">Price</option>
                    </select>
                </div>
                <div class="pr-6">
                    <div class="text-gray-900 mb-1">
                        Order by direction:
                    </div>
                    <select name="sortDirection" id="sortDirection" wire:model.live="sortDirection" class="select cursor-pointer text-gray-900 rounded shadow ring-black ring-opacity-5 ring-1 border-none">
                        <option value="asc" selected>Ascendant</option>
                        <option value="desc">Descendant</option>
                    </select>
                </div>
            </div>
            <table class="my-8 table bg-white rounded-lg shadow">
                <thead class="font-bold">
                    <tr>
                        <td class="whitespace-nowrap pl-8 p-4">Name</td>
                        <td class="whitespace-nowrap p-4">Category</td>
                        <td class="whitespace-nowrap p-4">Price</td>
                        <td class="whitespace-nowrap p-4">Quantity</td>
                        <td class="whitespace-nowrap p-4">Description</td>
                        <td class="whitespace-nowrap pr-8 p-4">Add to cart</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="pl-8 p-4">{{ $product->name }}</td>
                        <td class="p-4">{{ $product->category->name }}</td>
                        <td class="p-4">{{ $product->price }}</td>
                        <td class="p-4">{{ $product->quantity }}</td>
                        <td class="p-4">{{ $product->description }}</td>
                        <td class="pr-8 p-4 text-center text-5xl font-bold text-green-600">
                            <button type="button" wire:click="addToCart({{ $product->id }})">+</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>
    </div>

