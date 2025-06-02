<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-100 p-6 rounded shadow text-center">
            <p class="text-xl font-semibold text-gray-700 dark:text-gray-600">Total Produk</p>
            <p class="text-3xl text-indigo-500 mt-2">{{ $totalProducts }}</p>
        </div>
        <div class="bg-white dark:bg-gray-100 p-6 rounded shadow text-center">
            <p class="text-xl font-semibold text-gray-700 dark:text-gray-600">Pesanan Terkonfirmasi</p>
            <p class="text-3xl text-green-500 mt-2">{{ $totalConfirmed }}</p>
        </div>
        <div class="bg-white dark:bg-gray-100 p-6 rounded shadow text-center">
            <p class="text-xl font-semibold text-gray-700 dark:text-gray-600">Pesanan Pending</p>
            <p class="text-3xl text-red-500 mt-2">{{ $totalPending }}</p>
        </div>
    </div>
            </div>
        </div>
    </div>
</x-app-layout>
