@php
    use App\Models\Product;
    use App\Models\Categorie;
    use App\Models\OrderStatus;
    use Carbon\Carbon;

    $created_at = Carbon::parse($order->created_at)->setTimezone('Europe/Berlin');
    $created_at = $created_at->format('d-m-Y H:i:s');

    $updated_at = Carbon::parse($order->updated_at)->setTimezone('Europe/Berlin');
    $updated_at = $updated_at->format('d-m-Y H:i:s');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
            {{ __(date('d-m-Y', strtotime($order->created_at)) . ' / ' . $order->customer_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                    <h5 class="dark:text-gray-500">Progress</h5>

                    <div class="flex flex-row gap-3">
                        @php
                            $statuses = OrderStatus::all();
                        @endphp

                        @foreach ($statuses as $status)
                            @if ($order->status->id >= $status->id)
                                @if ($order->status->id == 6)
                                    <div class="w-full flex flex-col gap-1">
                                        <div class="bg-red-600 h-1 w-full rounded-sm"></div>
                                        <span class="text-gray-500">{{ $status->name }}</span>
                                    </div>
                                @else
                                    <div class="w-full flex flex-col gap-1">
                                        <div class="bg-gray-100 h-1 w-full rounded-sm"></div>
                                        <span class="text-gray-100">{{ $status->name }}</span>
                                    </div>
                                @endif
                            @else
                                <div class="w-full flex flex-col gap-1">
                                    <div class="bg-gray-600 h-1 w-full rounded-sm"></div>
                                    <span class="text-gray-500">{{ $status->name }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                    <div class="grid grid-cols-4 grid-rows-1 dark:text-gray-500">
                        <h5>Product</h5>
                        <h5 class="justify-self-end">Status</h5>
                        <h5 class="justify-self-end">Quantity</h5>
                        <h5 class="justify-self-end">Price</h5>
                    </div>

                    @foreach ($order->orderrow as $orderrow)
                        @php
                            $product = Product::find($orderrow->product_id);
                            $categorie = Categorie::find($product['categorie_id']);
                        @endphp

                        <div class="grid grid-cols-4 grid-rows-1 py-2">
                            <div class="flex">
                                <img class="max-h-16 rounded-md" src="{{ $product['img_src'] }}" />
                                <div class="flex flex-col justify-between">
                                    <p class="mx-4">{{ $product['name'] }}</p>
                                    <p class="mx-4 dark:text-gray-500">{{ $categorie['name'] }}</p>
                                </div>
                            </div>
                            <span class="mt-10 justify-self-end px-2 py-1 border rounded-md font-semibold text-xs uppercase tracking-widest {{ strtolower($orderrow->status->name) }}">{{ $orderrow->status->name }}</span>
                            <p class="mt-10 justify-self-end">{{ $orderrow->quantity }}x</p>
                            <p class="mt-10 justify-self-end">€ {{ number_format($orderrow->price, 2, ',') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                    <h5 class="dark:text-gray-500">Customer information</h5>

                    <div class="flex flex-col gap-2">
                        <span>{{ $order->customer_name }}</span>
                        <span>{{ $order->email }}</span>
                        <span>{{ $order->phone }}</span>
                    </div>

                    <h5 class="dark:text-gray-500">Delivery information</h5>

                    <div class="flex flex-col gap-2">
                        <span>{{ $order->zipcode }}, {{ $order->city }}</span>
                        <span>{{ $order->address }}</span>
                    </div>

                    <h5 class="dark:text-gray-500">Order information</h5>

                    <div class="flex flex-row justify-between">
                        <div class="flex flex-col gap-2">
                            <span>Created at: {{ $created_at }}</span>
                            <span>Updated at: {{ $updated_at }}</span>
                            <span>Total price: € {{ number_format($order->price, 2, ',') }}</span>
                        </div>

                        <div onclick="location.href='{{ route('orders.edit', ['order'=>$order->id]) }}'" class="flex justify-center items-center cursor-pointer h-12 w-12 border-2 rounded-full border-gray-500 self-end">
                            <img src="{{ url('/assets/icons/edit.svg') }}" alt="edit records" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
