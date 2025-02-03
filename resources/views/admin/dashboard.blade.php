<x-app-layout>
    
    <div class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Admin Dashboard</h1>
            <p class="text-xl text-gray-300">Manage Products, view orders, and configure settings.</p>
        </div>
    </div>

    
    @if (session('success'))
        <div id="success-message" class="fixed top-4 right-4 p-4 bg-green-500 text-white text-sm font-medium rounded-lg shadow-md transform transition-all duration-300 ease-in-out opacity-100 scale-100 flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4m1 5h1a4 4 0 1 0 -4 -4v1l3 3"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <script>
            // Set timeout to hide the success message after 3 seconds (3000 milliseconds)
            setTimeout(function () {
                const successMessage = document.getElementById('success-message');
                if (successMessage) {
                    // Apply slide-out to the right animation
                    successMessage.classList.add('translate-x-full', 'opacity-0'); // Slide right and fade out
                    setTimeout(function () {
                        successMessage.style.display = 'none'; // Hide after animation
                    }, 300); // Wait for the slide-out to complete
                }
            }, 3000); // Show message for 3 seconds
        </script>
    @endif

    
    <div class="max-w-7xl mx-auto px-6 py-8">
        <a href="{{ route('products.create') }}" class="bg-teal-600 px-6 py-3 text-white rounded-full font-semibold hover:bg-teal-700 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg">
            Add New Product
        </a>
    </div>

    
    <div class="max-w-7xl mx-auto px-6 pb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Existing Products</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-6 py-4 text-gray-700 font-semibold">#</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Name</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Brand</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Price</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Category</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Stock</th>
                        <th class="px-6 py-4 text-gray-700 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->brand }}</td>
                            <td class="px-6 py-4 text-gray-600">${{ $product->price }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ ucfirst($product->category) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $product->stock }}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('products.show', $product->id) }}" class="bg-green-500 hover:bg-green-600 text-white text-sm py-2 px-4 rounded-full shadow-md transition duration-300 transform hover:scale-105">
                                    View
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-2 px-4 rounded-full shadow-md transition duration-300 transform hover:scale-105">
                                    Edit
                                </a>
                                <form action="{{ route('products.delete', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-2 px-4 rounded-full shadow-md transition duration-300 transform hover:scale-105">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>