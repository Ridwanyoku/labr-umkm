<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-800">

    <header class="bg-gray-800 shadow p-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-200">Kogarigami</h1>
        </div>
        @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
    </header>

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-600">
                            No Image
                        </div>
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ $product->description }}</p>
                        <p class="text-gray-200 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }},00</p>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($products->isEmpty())
            <p class="text-center mt-10 text-gray-500">No products found.</p>
        @endif
    </main>
</body>
    <footer class="bg-gray-800">
        <div class="max-w-7x1 mx-auto">
            <h1 class="grid place-content-center text-gray-500">© 2025 Ridwan Adji Q 11 PPLG 1, All rights reserved.</h1>
        </div>
    <footer>
</html>