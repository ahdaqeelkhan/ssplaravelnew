<x-app-layout>
    <!-- Hero Section -->
    <div class="relative w-full h-[70vh] bg-gray-900 flex items-center justify-start overflow-hidden">
        <!-- Background Video Overlay -->
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover opacity-50">
            <source src="{{ asset('videos/products-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-transparent to-transparent"></div>

        <!-- Content Container -->
        <div class="relative z-10 max-w-2xl px-6 py-12 ml-12 text-left">
            <h1 class="text-7xl font-bold mb-6 animate-fade-in-up text-white">Built for You</h1>
            <p class="text-2xl text-gray-300 animate-fade-in-up delay-100">Discover the art of precision with our exclusive collection of luxury watches.</p>
            <a href="#products" class="mt-8 inline-block bg-teal-600 px-8 py-4 text-white rounded-full font-semibold hover:bg-teal-700 transition duration-300 shadow-lg focus:outline-none scroll-smooth">
                Explore Collection
            </a>
        </div>
    </div>

    <!-- Featured Products Section -->
    <section id="products" class="max-w-7xl mx-auto px-6 py-20 scroll-mt-20">
        <div class="text-center mb-12">
            <h2 class="text-5xl font-bold text-gray-800">Our Collection</h2>
            <p class="text-gray-600 mt-2">Handcrafted masterpieces for every occasion.</p>
        </div>

        <!-- Livewire Product Search Component -->
        <div class="mb-12">
            @livewire('product-search') {{-- Livewire component for search and product rendering --}}
        </div>
    </section>

    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 1s ease-out forwards; }
        .animate-fade-in-up.delay-100 { animation-delay: 0.1s; }
        .animate-fade-in-up.delay-200 { animation-delay: 0.2s; }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</x-app-layout>