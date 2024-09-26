<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Update form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data" class="grid max-w-xl">
                        @method('PUT')
                        @csrf
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Product information</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update the product information.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-red-600">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </header>

                        <div class="mt-6">
                            <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input id="name" name="name" type="text" value="{{ $product->name }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="description" class="block font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea id="description" name="description" class="max-h-56 h-24 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">{{ $product->description }}</textarea>
                        </div>
            
                        <div class="mt-6">
                            <label for="price" class="block font-medium text-gray-700 dark:text-gray-300">Price (€)</label>
                            <input id="price" name="price" type="number" min="0" step="any" value={{ number_format($product->price, 2, '.') }} class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="image" class="block font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input id="image" name="image" type="file" accept="image/*" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="categorie_id" class="block font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select id="categorie_id" name="categorie_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                @foreach ($categories as $categorie)
                                    @if ($product->categorie->id == $categorie->id)
                                        <option value="{{ $categorie->id }}" selected>{{ $categorie->name }}</option>
                                    @else
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endif
                                @endforeach
                            <select>
                        </div>

                        <div class="mt-6">
                            <label for="color" class="block font-medium text-gray-700 dark:text-gray-300">Color</label>
                            <input id="color" name="color" type="text" value="{{ $product->color}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>
                        
                        <div class="mt-6">
                            <label for="height_cm" class="block font-medium text-gray-700 dark:text-gray-300">Height (cm)</label>
                            <input id="height_cm" name="height_cm" type="number" min="0" value="{{ $product->height_cm }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="width_cm" class="block font-medium text-gray-700 dark:text-gray-300">Width (cm)</label>
                            <input id="width_cm" name="width_cm" type="number" min="0" value="{{ $product->width_cm }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="depth_cm" class="block font-medium text-gray-700 dark:text-gray-300">Depth (cm)</label>
                            <input id="depth_cm" name="depth_cm" type="number" min="0" value="{{ $product->depth_cm }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <div class="mt-6">
                            <label for="weight_gr" class="block font-medium text-gray-700 dark:text-gray-300">Weight (gr)</label>
                            <input id="weight_gr" name="weight_gr" type="number" min="0" value="{{ $product->weight_gr }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
                        </div>

                        <button type="submit" class="mt-6 w-min inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.destroy', ['product' => $product->id])}}" method="post" class="grid max-w-xl">
                        @method('DELETE')
                        @csrf

                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete Product</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Once the product is deleted, all of its resources and data will be permanently deleted. Before deleting this product, please download any data or information that you wish to retain.</p>
                        </header>

                        <button type="submit" class="mt-6 w-min items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
