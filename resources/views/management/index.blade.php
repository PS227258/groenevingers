<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight align-center">
            {{ __('Kuin B.V.') }}
        </h2>

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <button onclick="location.href='{{ route('management.create') }}'" class="justify-self-end align-end w-min h-full max-h-8 inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Bestellen</button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-2">
                    @foreach ($products as $product)
                        <div class="grid grid-cols-3 grid-rows-1">
                            <span class="p-2">{{ $product['name'] }}</span>
                            <span class="py-2 text-center">€ {{ number_format($product['price'], 2, ',') }}</span>

                            @if(Auth::user()->role->name === "Admin" || Auth::user()->role->name === "Accountant" || Auth::user()->role->name === "Manager")
                                <button onclick="location.href='{{ route('management.show', ['management' => $product['id']])}}'" class="justify-self-end align-end w-min my-1 h-full max-h-8 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Beheer</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>