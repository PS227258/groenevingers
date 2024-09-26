@php
    use App\Models\Product;
    use App\Models\Categorie;
    use App\Models\OrderStatus;
    use App\Models\OrderrowStatus;
    use Carbon\Carbon;

    $created_at = Carbon::parse($order->created_at)->setTimezone('Europe/Berlin');
    $created_at = $created_at->format('d-m-Y H:i:s');

    $updated_at = Carbon::parse($order->updated_at)->setTimezone('Europe/Berlin');
    $updated_at = $updated_at->format('d-m-Y H:i:s');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="flex flex-row gap-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
            <span class="flex flex-row cursor-pointer" onclick="location.href='{{ route('orders.show', ['order' => $order->id]) }}'"><img src="{{ url('assets/icons/arrow_back.svg') }}" /></span>{{ __(date('d-m-Y', strtotime($order->created_at)) . ' / ' . $order->customer_name) }}
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

                    <div class="flex flex-row justify-between content-end">
                        <div class="flex flex-row gap-2">
                            <form
                                action="{{ route('orders.updateStatus', ['id' => $order->id, 'statusId' => $order->status->id]) }}"
                                method="post">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="justify-self-end align-end w-28 mt-4 h-full max-h-8 inline-flex items-center justify-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Proceed</button>
                            </form>

                            <form
                                action="{{ route('orders.rollbackStatus', ['id' => $order->id, 'statusId' => $order->status->id]) }}"
                                method="post">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="justify-self-end align-end w-28 max-w-28 mt-4 h-full max-h-8 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Roll
                                    back</button>
                            </form>
                        </div>

                        <form action="{{ route('orders.cancelOrder', ['id' => $order->id]) }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="justify-self-end align-end w-min mt-4 h-full max-h-8 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 transition ease-in-out duration-150">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                    <div class="grid grid-cols-6 grid-rows-1 dark:text-gray-500">
                        <h5>Product</h5>
                        <h5 class="justify-self-end">Status</h5>
                        <h5 class="justify-self-end">Quantity</h5>
                        <h5 class="justify-self-end">Price</h5>
                    </div>

                    @foreach ($order->orderrow as $orderrow)
                        @php
                            $product = Product::find($orderrow->product_id);
                            $categorie = Categorie::find($product['categorie_id']);
                            $orderrowStatuses = OrderrowStatus::all();
                        @endphp

                        <div class="grid grid-cols-6 grid-rows-1 py-2">

                            <div class="flex">
                                <img class="max-h-16 rounded-md" src="{{ $product['img_src'] }}" />
                                <div class="flex flex-col justify-between">
                                    <p class="mx-4">{{ $product['name'] }}</p>
                                    <p class="mx-4 dark:text-gray-500">{{ $categorie['name'] }}</p>
                                </div>
                            </div>

                            <form action="{{ route('orders.updateOrderRow', ['id' => $orderrow->id] )}}" method="post" class="col-span-4 grid grid-cols-4 w-full justify-end items-end">
                            @csrf
                            @method('POST')
                                <input type="hidden" name="order_id" value="{{ $order->id }}" />
                                <select name="orderrow_status" class="px-4 py-1 rounded-md justify-self-end align-self-end max-h-8 w-3/4 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                    @foreach ($orderrowStatuses as $orderrowStatus)
                                        @if ($orderrowStatus->id === $orderrow->status_id)
                                            <option selected value="{{ $orderrowStatus->id}}">{{ $orderrowStatus->name }}</option>
                                        @else
                                            <option value="{{ $orderrowStatus->id}}">{{ $orderrowStatus->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                                                
                                <select name="orderrow_quantity" class="px-4 py-1 rounded-md justify-self-end align-self-end max-h-8 w-1/2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                    @for ($i = 1; $i < 10; $i++)
                                        @if ($orderrow->quantity == $i)
                                            <option selected value="{{ $i }}">{{ $i }}</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>

                                <p class="align-self-end justify-self-end">€ {{ number_format($orderrow->price, 2, ',') }}</p>
                                
                                <button type="submit" class="justify-self-end align-end w-min-content h-full max-h-8 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save</button>
                            </form>
                            <form
                                action="{{ route('orders.destroyOrderRow', ['id' => $order->id, 'rowId' => $orderrow->id]) }}"
                                method="post" class="justify-self-end self-end">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-min items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('orders.updateOrderInformation', ['id' => $order->id]) }}" method="post" class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-4">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h5 class="dark:text-gray-500">Customer information</h5>

                    <div class="flex flex-col gap-2 max-w-xl">
                        <label for="customer_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Customer name</label>
                        <input name="customer_name" id="customer_name" placeholder="{{ $order->customer_name }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                        
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input name="email" id="email" placeholder="{{ $order->email }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                        
                        <label for="phone" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Phone</label>
                        <input name="phone" id="phone" placeholder="{{ $order->phone }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                    </div>

                    <h5 class="dark:text-gray-500">Delivery information</h5>

                    <div class="flex flex-col gap-2 max-w-xl">
                        <label for="zipcode" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Zipcode</label>
                        <input name="zipcode" id="zipcode" placeholder="{{ $order->zipcode }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                         
                        <label for="address" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Adress</label>
                        <input name="address" id="address" placeholder="{{ $order->address }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                        
                        <label for="city" class="block font-medium text-sm text-gray-700 dark:text-gray-300">City</label>
                        <input name="city" id="city" placeholder="{{ $order->city }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                    </div>

                    <h5 class="dark:text-gray-500">Order information</h5>

                    <div class="flex flex-col gap-2 max-w-xl">
                        <label for="price" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total price (€)</label>
                        <input name="price" id="price" placeholder="{{ number_format($order->price, 2, ',') }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"/>
                    </div>

                    <button type="submit" class="inline-flex items-center w-min px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
