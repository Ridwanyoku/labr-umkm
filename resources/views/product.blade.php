<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Create Form --}}
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">Name</label>
                            <input type="text" name="name" class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Description</label>
                            <textarea name="description" class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:text-white" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Price</label>
                            <input type="number" name="price" class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:text-white" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Image</label>
                            <input type="file" name="image" class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Product</button>
                        </div>
                    </form>

                    {{-- Products Table --}}
                    <table class="min-w-full bg-white dark:bg-gray-700 mt-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Description</th>
                                <th class="px-4 py-2 border">Price</th>
                                <th class="px-4 py-2 border">Image</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="text-gray-800 dark:text-white">
                                    <td class="border px-4 py-2">{{ $product->name }}</td>
                                    <td class="border px-4 py-2">{{ $product->description }}</td>
                                    <td class="border px-4 py-2">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="product image" class="h-16">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{-- Delete --}}
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">Delete</button>
                                        </form>
                                        <a href="{{ route('product.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded w-full text-center block">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            
                            @if($products->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">No products found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
