
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="relative min-h-screen flex flex-col py-12">
        <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-5">
            <table class="my-8 table bg-white rounded-lg shadow self-start">
                <thead class="font-bold">
                    <tr>
                        <td class="whitespace-nowrap pl-8 p-4">Name</td>
                        <td class="whitespace-nowrap p-4">Price</td>
                        <td class="whitespace-nowrap p-4">Quantity</td>
                        <td class="whitespace-nowrap pr-8 p-4">Remove from cart</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td class="pl-8 p-4">{{ $item['name'] }}</td>
                        <td class="p-4">{{ $item['price'] }}</td>
                        <td class="p-4">{{ $item['quantity'] }}</td>
                        <td class="pr-8 p-4 text-center text-5xl font-bold text-red-600">
                            <button type="button" wire:click="removeFromCart({{ $id }})">-</button>
                        </td>
                    </tr>
                @endforeach
                    <tr class="font-bold">
                        <td class="pl-8 p-4"></td>
                        <td class="p-4"></td>
                        <td class="p-4"></td>
                        <td class="pr-8 p-4 text-right">Total amount: {{ $totalAmount }}</td>
                    </tr>
                </tbody>
            </table>
            <form wire:submit="saveOrder" class="form p-8 my-8 flex flex-col bg-white rounded-lg shadow space-y-6 self-start">
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Name
                    </label>
                    <input type="text" wire:model="userName" name="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Email
                    </label>
                    <input type="email" wire:model="userEmail" name="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="phone">
                        Phone
                    </label>
                    <input type="tel" wire:model="userPhone" name="phone" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="address">
                        Address
                    </label>
                    <input type="text" wire:model="userAddress" name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
                @if ($error)
                    <div class="mb-6 text-red-500">Error: {{ $error }}</div>
                @endif
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Order
                    </button>
                </div>
            </form>
        </main>
    </div>

