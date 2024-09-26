<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Update form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.update', ['user' => $user->id])}}" method="post" class="grid max-w-xl">
                        @method('PUT')
                        @csrf
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Profile information</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update the account's profile information.</p>
                            @error('phone')
                                <div class="text-red-600 mt-2">{{ "Fill in a valid phonenumber" }}</div>
                            @enderror
                        </header>

                        <div class="mt-6">
                            <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input id="name" name="name" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" type="text" value="{{ $user->name}}">
                        </div>
                        
                        <div class="mt-6">
                            <label for="email" class="block font-medium text-gray-700 dark:text-gray-300">Email</label>
                             <input id="email" name="email" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" type="text" value="{{ $user->email }}">
                        </div>

                        <div class="mt-6">
                            <label for="phone" class="block font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input id="phone" name="phone" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" type="tel" value="{{ old('phone', $user->phone) }}">

                        </div>

                        <div class="mt-6">
                            <label for="status" class="block font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                @foreach ($statuses as $status)
                                    @if ($user->status->id === $status->id)
                                        <option value={{$status->id}} selected>{{$status->name}}</option>
                                    @else
                                        <option value={{$status->id}}>{{$status->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mt-6">
                            <label for="branch" class="block font-medium text-gray-700 dark:text-gray-300">Branch</label>
                            <select id="branch" name="branch" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                @foreach ($branches as $branch)
                                    @if ($user->branch->id === $branch->id)
                                        <option value={{$branch->id}} selected>{{$branch->name}}</option>
                                    @else
                                        <option value={{$branch->id}}>{{$branch->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        @if (Auth::user()->role->name === "Admin")
                            <div class="mt-6">
                                <label for="role" class="block font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select id="role" name="role" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm rounded">
                                    @foreach ($roles as $role)
                                        @if ($user->role->id === $role->id)
                                            <option value={{$role->id}} selected>{{$role->name}}</option>
                                        @else
                                            <option value={{$role->id}}>{{$role->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <button type="submit" class="mt-6 w-min inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.destroy', ['user' => $user->id])}}" method="post" class="grid max-w-xl">
                        @method('DELETE')
                        @csrf

                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete Account</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting this account, please download any data or information that you wish to retain.</p>
                        </header>

                        <button type="submit" class="mt-6 w-min items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
