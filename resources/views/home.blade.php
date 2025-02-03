<x-app-layout>
    
    <div class="relative w-full h-screen bg-gray-900 flex items-center justify-center overflow-hidden">
        <!-- Background Video -->
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover opacity-50">
            <source src="{{ asset('videos/rolex-herovideo.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-transparent to-transparent"></div>  

        
        <div class="relative z-10 text-center text-white max-w-4xl px-6">
            <h1 class="text-7xl font-bold mb-6 animate-fade-in-up">Timeless Elegance, Redefined</h1>
            <p class="text-2xl text-gray-300 mb-8 animate-fade-in-up delay-100">Discover the perfect blend of style and precision with our exclusive collection of luxury watches.</p>
            <a href="#collection" class="bg-teal-600 px-12 py-5 text-white rounded-full font-semibold hover:bg-teal-700 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg animate-fade-in-up delay-200">Explore Collection</a>
        </div>
    </div>

    <!-- Featured Collection Section -->
    <div id="collection" class="bg-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-5xl font-bold text-center text-white mb-12 animate-fade-in-up">Find Your Taste</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition duration-300 transform hover:-translate-y-2 animate-fade-in-up">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover">
                        <div class="p-8">
                            <h3 class="text-2xl font-semibold text-white mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-300 text-lg mb-4">{{ $product->brand }}</p>
                            <p class="text-white font-bold text-2xl mb-6">${{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('product.details', $product->id) }}" class="text-teal-400 hover:text-teal-500 font-semibold text-lg hover:underline transition duration-300">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Highlight Section -->
    <div class="bg-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
            
            <div class="w-full md:w-1/2 animate-fade-in-left">
                <img src="{{ asset('images/rolex-highlight.jpg') }}" alt="Futuristic Watch" class="rounded-3xl shadow-2xl">
            </div>
            
            <div class="w-full md:w-1/2 animate-fade-in-right">
                <h2 class="text-5xl font-bold text-white mb-6">Craftsmanship Meets Innovation</h2>
                <p class="text-xl text-gray-300 mb-8">Our watches are meticulously crafted with precision and passion, blending timeless design with cutting-edge technology. Each piece tells a story of elegance and sophistication.</p>
                <a href="#collection" class="bg-teal-600 px-12 py-5 text-white rounded-full font-semibold hover:bg-teal-700 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg">Explore More</a>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-gray-900 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-5xl font-bold text-center text-white mb-12 animate-fade-in-up">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl shadow-2xl animate-fade-in-up">
                    <p class="text-gray-300 text-lg mb-6">"The craftsmanship is unparalleled. I’ve never owned a watch that feels so luxurious and precise."</p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/user1.jpg') }}" alt="User 1" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-semibold text-white">Sam Witwicky</p>
                            <p class="text-gray-400">Luxury Enthusiast</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl shadow-2xl animate-fade-in-up delay-100">
                    <p class="text-gray-300 text-lg mb-6">"Every detail is perfect. It’s not just a watch; it’s a statement."</p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/user2.jpg') }}" alt="User 2" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-semibold text-white">Megan Daniela</p>
                            <p class="text-gray-400">Fashion Influencer</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl shadow-2xl animate-fade-in-up delay-200">
                    <p class="text-gray-300 text-lg mb-6">"The perfect blend of style and functionality. I’m in love with my new watch!"</p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/user3.jpg') }}" alt="User 3" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-semibold text-white">Justin Black</p>
                            <p class="text-gray-400">Watch Collector</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call-to-Action Section -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 py-20">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-6xl font-bold text-white mb-6 animate-fade-in-up">Ready to Elevate Your Style?</h2>
            <p class="text-2xl text-gray-100 mb-8 animate-fade-in-up delay-100">Explore our exclusive collection of luxury watches and find the perfect timepiece for every occasion.</p>
            <a href="{{ route('products.index') }}" class="bg-white px-12 py-5 text-teal-600 rounded-full font-semibold hover:bg-gray-100 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg animate-fade-in-up delay-200">Shop Now</a>
        </div>
    </div>

    
    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fade-in-up 1s ease-out forwards; }
        .animate-fade-in-up.delay-100 { animation-delay: 0.1s; }
        .animate-fade-in-up.delay-200 { animation-delay: 0.2s; }

        @keyframes fade-in-left {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-left { animation: fade-in-left 1s ease-out forwards; }

        @keyframes fade-in-right {
            0% { opacity: 0; transform: translateX(20px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-right { animation: fade-in-right 1s ease-out forwards; }
    </style>
</x-app-layout>