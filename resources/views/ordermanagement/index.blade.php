<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                    <div class="grid grid-cols-6 grid-rows-1 dark:text-gray-500">
                        <h5 class="text-center cursor-pointer" onclick="location.href='{{ route('orders.sortOrders', ['key' => 'customer_name']) }}'">Customer name</h5>
                        <h5 class="text-center cursor-pointer" onclick="location.href='{{ route('orders.sortOrders', ['key' => 'created_at']) }}'">Created at</h5>
                        <h5 class="text-center cursor-pointer" onclick="location.href='{{ route('orders.sortOrders', ['key' => 'price']) }}'">Price</h5>
                        <h5 class="text-center cursor-pointer" onclick="location.href='{{ route('orders.sortOrders', ['key' => 'items']) }}'">Items</h5>
                        <h5 class="text-center cursor-pointer" onclick="location.href='{{ route('orders.sortOrders', ['key' => 'status_id']) }}'">Order status</h5>
                    </div>

                    @foreach($orders as $order)
                        <div class="grid grid-cols-6 grid-rows-1 py-2 justify-center">
                            <p class="text-center my-2">{{ $order->customer_name }}</p>
                            <p class="text-center my-2">{{ date('M d, Y', strtotime($order->created_at)) }}</p>
                            <p class="text-center my-2">€ {{ number_format($order->price, 2, ',') }}</p>
                            @php 
                                $i = null;
                            @endphp
                            
                            @foreach($order->orderrow as $row)
                                @php 
                                    $i = $i + $row->quantity 
                                @endphp
                            @endforeach
                            <p class="text-center my-2">{{ $i }}</p>
                            <p class="justify-self-center my-2 text-center w-32 h-min text-center font-weight rounded {{ strtolower($order->status->name) }}">{{ $order->status->name }}</p>
                            <button onclick="location.href='{{ route('orders.show', ['order' => $order->id]) }}'" class="justify-self-end align-end w-min my-1 h-full max-h-8 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Beheer</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>