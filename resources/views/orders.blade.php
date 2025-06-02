<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Daftar Pesanan') }}
        </h2>
    </x-slot>


    <div class="py-6 max-w-7xl mx-auto">
        {{-- Pesanan Belum Dikonfirmasi --}}
        <div class="bg-white dark:bg-gray-200 p-6 rounded shadow mb-6">
            <h3 class="text-lg font-bold mb-4 text-gray-800 ">Belum Dikonfirmasi</h3>
            @forelse ($pendingOrders as $order)
                <div class="border-b border-gray-300 dark:border-gray-600 py-4">
                    <p><strong>{{ $order->name }}</strong> memesan <strong>{{ $order->quantity }}</strong> item <strong>{{ $order->product->name }}</strong></p>
                    <p>Email: {{ $order->email }}, Telepon: {{ $order->phone }}</p>
                    <form action="{{ route('orders.confirm', $order->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="px-4 py-2 bg-blue-500 text-white rounded">Konfirmasi</button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada pesanan menunggu konfirmasi.</p>
            @endforelse
        </div>

        {{-- Pesanan Dikonfirmasi --}}
        <div class="bg-white dark:bg-gray-200 p-6 rounded shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Sudah Dikonfirmasi</h3>
            @forelse ($confirmedOrders as $order)
                <div class="border-b border-gray-300 dark:border-gray-600 py-4">
                    <p><strong>{{ $order->name }}</strong> memesan <strong>{{ $order->quantity }}</strong> item <strong>{{ $order->product->name }}</strong></p>
                    <p>Email: {{ $order->email }}, Telepon: {{ $order->phone }}</p>
                    <p>Status: <span class="text-green-500 font-semibold">Dikonfirmasi</span></p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada pesanan yang dikonfirmasi.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
