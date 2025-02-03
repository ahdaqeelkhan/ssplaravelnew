<x-app-layout>
    
    <div class="relative w-full h-[40vh] bg-gray-900 flex items-center justify-center overflow-hidden">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-teal-600/50 to-cyan-600/50"></div>

        
        <div class="relative z-10 text-center text-white max-w-4xl px-6">
            <h1 class="text-5xl font-bold mb-4 animate-fade-in-up">{{ $product->name }}</h1>
            <p class="text-xl text-gray-300 animate-fade-in-up delay-100">Discover the perfect blend of style and precision.</p>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12" x-data="{ quantity: 1, price: {{ $product->price }}, stock: {{ $product->stock }} }">
            
            <div class="relative">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-auto rounded-3xl shadow-2xl transform transition duration-500 hover:scale-105">

                <!-- Stock Count Badge -->
                <div class="absolute top-4 right-4 px-6 py-2 rounded-full text-lg font-semibold shadow-lg text-white"
                    :class="stock === 0 ? 'bg-red-600' : 'bg-teal-600'">
                    <span x-text="stock > 0 ? stock + ' in Stock' : 'Out of Stock'"></span>
                </div>
            </div>

            
            <div class="space-y-8">
                <h2 class="text-4xl font-bold text-white mb-6">{{ $product->name }}</h2>
                <div class="space-y-6">
                    <p class="text-xl text-gray-300"><strong>Brand:</strong> {{ $product->brand }}</p>
                    <p class="text-xl text-gray-300"><strong>Price:</strong> 
                        <span class="text-teal-400 font-semibold">${{ number_format($product->price, 2) }}</span>
                    </p>
                    <p class="text-xl text-gray-300"><strong>Category:</strong> {{ ucfirst($product->category) }}</p>
                    <p class="text-xl text-gray-300"><strong>Description:</strong>
                        {{ $product->description ?? 'No description available.' }}</p>
                </div>

                <!-- Quantity Selector -->
                <div class="flex items-center space-x-6">
                    <button @click="if(quantity > 1) quantity--"
                        class="bg-gray-700 text-white py-3 px-6 rounded-full hover:bg-gray-600 transition duration-300">
                        -
                    </button>
                    <span class="text-2xl font-semibold text-white" x-text="quantity"></span>
                    <button @click="if(quantity < stock) quantity++"
                        class="bg-gray-700 text-white py-3 px-6 rounded-full hover:bg-gray-600 transition duration-300">
                        +
                    </button>
                </div>

                <!-- Updated Price Display -->
                <p class="text-xl text-gray-300 mt-4"><strong>Total Price:</strong> 
                    <span class="text-teal-400 font-semibold" x-text="'$' + (quantity * price).toFixed(2)"></span>
                </p>

                
                <form action="{{ route('cart.add') }}" method="POST" class="mt-8" @submit.prevent="if(quantity <= stock) { $el.submit(); stock -= quantity }">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" x-model="quantity">
                    <button type="submit"
                        class="bg-teal-600 px-12 py-5 text-white rounded-full font-semibold transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg w-full"
                        :class="{ 'opacity-50 cursor-not-allowed': stock === 0 }" :disabled="stock === 0">
                        Add to Cart
                    </button>
                </form>


            </div>
        </div>
    </div>

    
    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 py-20">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-5xl font-bold text-white mb-6">Ready to Elevate Your Style?</h2>
            <p class="text-2xl text-gray-100 mb-8">Explore our exclusive collection of luxury watches and find the perfect timepiece for every occasion.</p>
            <a href="{{ route('products.index') }}"
                class="bg-white px-12 py-5 text-teal-600 rounded-full font-semibold hover:bg-gray-100 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg">
                Explore Collection
            </a>
        </div>
    </div>

    
    <style>
        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }
        .animate-fade-in-up.delay-100 {
            animation-delay: 0.1s;
        }
        .animate-fade-in-up.delay-200 {
            animation-delay: 0.2s;
        }
    </style>
</x-app-layout>
