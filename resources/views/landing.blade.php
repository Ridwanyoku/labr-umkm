<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kogarigami - Toko Produk Kreatif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 text-gray-800">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-500 shadow-lg py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Your Image" width="100" height="100" />
                <h1 class="text-2xl font-bold text-white">Kogarigami</h1>
            </div>
            
            @if (Route::has('login'))
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-1 rounded-full text-white text-sm transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-1 rounded-full text-white text-sm transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white px-4 py-1 rounded-full text-indigo-700 text-sm hover:bg-gray-100 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
            @endif
        </div>
    </header>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="bg-green-600 text-white p-3 text-center">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Slider Sederhana -->
    {{-- <section class="py-6 px-4">
        <div class="max-w-7xl mx-auto mb-8">
            <div x-data="{ currentSlide: 0 }" class="relative h-64 rounded-xl overflow-hidden shadow-lg">
                <!-- Slide 1 -->
                <div x-show="currentSlide === 0" class="absolute inset-0 bg-gradient-to-r from-orange-400 to-yellow-500 flex items-center justify-center p-8">
                    <div class="text-center max-w-xl">
                        <h2 class="text-3xl font-bold text-white mb-3">Produk Terbaru!</h2>
                        <p class="text-lg text-white mb-5">Koleksi eksklusif musim ini</p>
                        <button class="bg-white px-6 py-2 rounded-full font-medium text-indigo-700">
                            Lihat Semua
                        </button>
                    </div>
                </div>
                
                <!-- Slide 2 -->
                <div x-show="currentSlide === 1" class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-700 flex items-center justify-center p-8">
                    <div class="text-center max-w-xl">
                        <h2 class="text-3xl font-bold text-white mb-3">Diskon Spesial!</h2>
                        <p class="text-lg text-white mb-5">Potongan hingga 30% untuk produk pilihan</p>
                        <button class="bg-white px-6 py-2 rounded-full font-medium text-indigo-700">
                            Beli Sekarang
                        </button>
                    </div>
                </div>
                
                <!-- Navigasi Slider -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                    <button @click="currentSlide = 0" class="w-3 h-3 rounded-full bg-white" :class="{ 'bg-indigo-700': currentSlide === 0 }"></button>
                    <button @click="currentSlide = 1" class="w-3 h-3 rounded-full bg-white" :class="{ 'bg-indigo-700': currentSlide === 1 }"></button>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Daftar Produk -->
    <main class="py-6 pb-16 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-10 text-indigo-800">Produk kami</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($products as $product)
                <div x-data="{ open: false }" class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <!-- Product Image -->
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                            <i class="fas fa-image text-indigo-300 text-4xl"></i>
                        </div>
                    @endif
                    
                    <!-- Product Details -->
                    <div class="p-5">
                        <h2 class="text-lg font-semibold mb-2 text-gray-900">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($product->description, 70) }}</p>
                        
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-indigo-700">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <button @click="open = true" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg text-white text-sm">
                                <i class="fas fa-shopping-cart mr-1"></i> Pesan
                            </button>
                        </div>
                    </div>

                    <!-- Modal Pesan -->
                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                        <div @click.away="open = false" class="bg-white rounded-xl w-full max-w-md overflow-hidden">
                            <div class="bg-indigo-600 p-4 text-white">
                                <h3 class="text-xl font-bold">Pesan {{ $product->name }}</h3>
                            </div>
                            
                            <form action="{{ route('order.store') }}" method="POST" class="space-y-4 p-5">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" placeholder="Nama Anda" class="w-full p-2 border rounded-lg" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                                    <input type="text" name="phone" placeholder="0812-3456-7890" class="w-full p-2 border rounded-lg" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-1">Email</label>
                                    <input type="email" name="email" placeholder="email@contoh.com" class="w-full p-2 border rounded-lg" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium mb-1">Jumlah</label>
                                    <input type="number" name="quantity" min="1" value="1" class="w-full p-2 border rounded-lg" required>
                                </div>
                                
                                <div class="flex justify-end gap-3 pt-4">
                                    <button type="button" @click="open = false" class="px-4 py-2 bg-gray-200 rounded-lg">
                                        Batal
                                    </button>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg text-white">
                                        Kirim Pesanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <div class="text-center py-16">
                    <i class="fas fa-box-open text-4xl text-indigo-300 mb-4"></i>
                    <p class="text-xl text-gray-600">Belum ada produk tersedia</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer Sederhana -->
    <footer class="bg-gradient-to-r from-indigo-800 to-blue-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="mb-4">
                <i class="fas fa-store mr-2"></i>Kogarigami - Toko Produk Kreatif
            </p>
            <div class="flex justify-center gap-4 mb-4">
                <a href="#" class="text-blue-300 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-blue-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-blue-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-blue-300 hover:text-white"><i class="fab fa-tiktok"></i></a>
            </div>
            <p>
                © 2025 Ridwan Adji Q 11 PPLG 1, All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>