<div>
    <!-- Search Bar with Styling -->
    <input 
    type="text" 
    wire:model="search"  
    wire:keydown.enter="searchProduct" 
    class="border-2 border-teal-500 p-3 rounded-md w-full mb-4 text-lg focus:outline-none focus:ring-2 focus:ring-teal-500 placeholder:text-gray-400 transition-all"
    placeholder="Search for products..."
/>


    <!-- Display Products After Search -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
        @foreach ($products as $product)
            <div class="border p-4 rounded-xl">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-xl">
                <h3 class="text-lg font-semibold mt-4">{{ $product->name }}</h3>
                <p class="text-gray-500 mt-2">{{ $product->brand }}</p>
                <p class="text-teal-600 mt-2">${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('product.details', $product->id) }}" class="text-teal-600 mt-4 block">View Details</a>
            </div>
        @endforeach
    </div>
</div>
