<div>
    <!-- Modern Translucent Search Bar -->
    <div class="relative mb-12">
        <div class="relative w-full max-w-3xl mx-auto">
            <input 
                type="text" 
                wire:model="search"  
                wire:keydown.enter="searchProduct" 
                class="w-full p-4 pl-12 text-lg text-white bg-gray-900/70 border border-teal-500 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 placeholder:text-gray-400 backdrop-blur-md transition-all"
                placeholder="Search for products..."
            />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- Display Products After Search -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse ($products as $product)
            <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-teal-600 group-hover:text-teal-700 transition-colors">{{ $product->name }}</h3>
                    <p class="text-gray-500 mt-2">{{ $product->brand }}</p>
                    <p class="text-teal-600 mt-2 font-semibold">${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('product.details', $product->id) }}" 
                       class="mt-4 inline-block text-teal-600 underline hover:text-teal-700 transition-colors duration-300">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400">
                <p>No products found. Try a different search term.</p>
            </div>
        @endforelse
    </div>
</div>