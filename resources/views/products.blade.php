<!-- resources/views/products.blade.php -->

<x-app-layout>
    <!-- Hero Section -->
    <div class="relative w-full h-[40vh] bg-gray-900 flex items-center justify-center overflow-hidden">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-teal-600/50 to-cyan-600/50"></div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white max-w-4xl px-6">
            <h1 class="text-5xl font-bold mb-4 animate-fade-in-up">Explore Our Products</h1>
            <p class="text-xl text-gray-300 animate-fade-in-up delay-100">Browse through a collection of top-tier timepieces.</p>
        </div>
    </div>

    <!-- Livewire Search Component -->
    <div class="max-w-7xl mx-auto px-6 py-6">
        @livewire('product-search')
    </div>

    <!-- Product Grid Section -->
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                    <a href="{{ route('product.details', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-500">${{ number_format($product->price, 2) }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
