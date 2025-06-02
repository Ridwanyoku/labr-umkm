<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea name="description" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Price</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Current Image</label><br>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="h-24 mb-2">
                        @else
                            <p class="text-sm text-gray-400">No image</p>
                        @endif
                        <input type="file" name="image" class="w-full p-2 rounded border dark:bg-gray-700 dark:text-white">
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Update</button>
                        <a href="{{ route('product.index') }}" class="text-blue-500 hover:underline">Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
