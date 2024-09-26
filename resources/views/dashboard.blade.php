<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Welkom {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</p>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="pb-6 font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">Charts</h3>
                <div class="flex flex-row gap-2">
                    <div class="text-gray-900 dark:text-gray-100 user-chart w-full max-w-xl">
                        {!! $userChart->renderHtml() !!}
                    </div>
                    <div class="text-gray-900 dark:text-gray-100 user-chart w-full max-w-xl">
                        {!! $orderChart->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
{!! $userChart->renderChartJsLibrary() !!}
{!! $userChart->renderJs() !!}

{!! $orderChart->renderChartJsLibrary() !!}
{!! $orderChart->renderJs() !!}