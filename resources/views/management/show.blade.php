<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product["name"] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.store') }}" method="POST" class="grid max-w-xl">
                    @method('POST')
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product information</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">More information about the product.</p>
                    </header>

                    <input id="api_id" name="api_id" hidden value="{{ $product["id"] }}">

                    <div class="mt-6">
                        <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input id="name" name="name" disabled value="{{ $product["name"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="name" hidden value="{{ $product["name"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="description" name="description" disabled class="max-h-56 h-24 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">{{ $product["description"] }}</textarea>
                        <textarea name="description" hidden>{{ $product["description"] }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label for="price" class="block font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input id="price" name="price" disabled value="{{ $product["price"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="price" hidden value="{{ $product["price"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="image" class="block font-medium text-gray-700 dark:text-gray-300">Image source</label>
                        <input id="image" name="image" disabled value="{{ $product["image"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="image" hidden value="{{ $product["image"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="color" class="block font-medium text-gray-700 dark:text-gray-300">Color</label>
                        <input id="color" name="color" disabled value="{{ $product["color"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="color" hidden value="{{ $product["color"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="height_cm" class="block font-medium text-gray-700 dark:text-gray-300">height_cm</label>
                        <input id="height_cm" name="height_cm" disabled value="{{ $product["height_cm"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="height_cm" hidden value="{{ $product["height_cm"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="width_cm" class="block font-medium text-gray-700 dark:text-gray-300">width_cm</label>
                        <input id="width_cm" name="width_cm" disabled value="{{ $product["width_cm"] }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="width_cm" hidden value="{{ $product["width_cm"] }}"/>
                    </div>

                    <div class="mt-6">
                        <label for="depth_cm" class="block font-medium text-gray-700 dark:text-gray-300">depth_cm</label>
                        <input id="depth_cm" name="depth_cm" disabled value="{{ $product["depth_cm"]}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="depth_cm" hidden value="{{ $product["depth_cm"]}}"/>
                    </div>

                    <div class="mt-6">
                        <label for="weight_gr" class="block font-medium text-gray-700 dark:text-gray-300">weight_gr</label>
                        <input id="weight_gr" name="weight_gr" disabled value="{{ $product["weight_gr"]}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"/>
                        <input name="weight_gr" hidden value="{{ $product["weight_gr"]}}"/>
                    </div>

                    <button type="submit" class="mt-6 w-min inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Add</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>