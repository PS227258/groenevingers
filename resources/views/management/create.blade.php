@php
    use App\Models\Product;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Place an order')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('management.store') }}" method="POST" class="grid max-w-xl">
                        @method('POST')
                        @csrf

                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Place a new order</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Place a new order at Kuin B.V.</p>
                        </header>

                        @if ($order_id)
                            <input id="order_id" name="order_id" type="hidden" value="{{ $order_id }}">
                        @endif
                    
                        <div class="mt-6">
                            <label for="product" class="block font-medium text-gray-700 dark:text-gray-300">Product</label>
                            <select id="product" name="product" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                @foreach($products as $product)
                                    <option value="{{ $product["id"] }}">{{ $product["name"] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6">
                            <label for="quantity" class="block font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <input id="quantity" name="quantity" min="0" max="100" value="1" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" type="number">
                        </div>

                        <button type="submit" class="mt-6 w-min inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Add</button>
                    </form>
                </div>
            </div>

            @if ($orderrows !== null)
                <form action="{{ route('management.update', ['management' => $order_id] )}}" method="POST" class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    @method("PUT")
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if (!is_array($orderrows))
                            <p>{{ $orderrow }}</p>
                        @else
                            @foreach ($orderrows as $orderrow)
                                @php
                                    $product = Product::getProductFromAPI($orderrow["product_id"]);
                                @endphp

                                <p>{{ $product["name"] }} - {{ $orderrow["quantity"] }}x</p>
                            @endforeach
                        @endif
                        <button type="submit" class="mt-6 w-min inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Finish</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>