<x-app-layout>
    <!-- Hero Section -->
    <div class="relative w-full h-[40vh] bg-gray-900 flex items-center justify-center overflow-hidden">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-teal-600/50 to-cyan-600/50"></div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white max-w-4xl px-6">
            <h1 class="text-5xl font-bold mb-4 animate-fade-in-up">Our Products</h1>
            <p class="text-xl text-gray-300 animate-fade-in-up delay-100">Discover the perfect blend of style and precision.</p>
        </div>
    </div>

    <!-- Product Listing Section -->
    <div class="max-w-7xl mx-auto px-6 py-20">
        <!-- Livewire Product Search Component -->
        <div class="bg-white/10 backdrop-blur-md rounded-3xl shadow-2xl p-8">
            @livewire('product-search') {{-- Livewire component for search and product rendering --}}
        </div>
    </div>

    <!-- Call-to-Action Section -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 py-20">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-5xl font-bold text-white mb-6 animate-fade-in-up">Ready to Elevate Your Style?</h2>
            <p class="text-2xl text-gray-100 mb-8 animate-fade-in-up delay-100">Explore our exclusive collection of luxury watches and find the perfect timepiece for every occasion.</p>
            <a href="{{ route('products.index') }}" class="bg-white px-12 py-5 text-teal-600 rounded-full font-semibold hover:bg-gray-100 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg animate-fade-in-up delay-200">Explore Collection</a>
        </div>
    </div>

    <!-- Custom Animations -->
    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 1s ease-out forwards; }
        .animate-fade-in-up.delay-100 { animation-delay: 0.1s; }
        .animate-fade-in-up.delay-200 { animation-delay: 0.2s; }
    </style>
</x-app-layout>