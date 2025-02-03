<x-app-layout>
    
    <div class="bg-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Add New Product</h1>
            <p class="text-xl text-gray-300">Fill out the form below to add a new product to your collection.</p>
        </div>
    </div>

    
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white/10 backdrop-blur-md rounded-3xl shadow-2xl p-8">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                
                <div class="mb-6">
                    <label for="name" class="block text-gray-300 font-medium mb-2">Product Name</label>
                    <input type="text" id="name" name="name" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" required>
                </div>

                
                <div class="mb-6">
                    <label for="brand" class="block text-gray-300 font-medium mb-2">Brand</label>
                    <input type="text" id="brand" name="brand" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" required>
                </div>

                
                <div class="mb-6">
                    <label for="price" class="block text-gray-300 font-medium mb-2">Price</label>
                    <input type="number" id="price" name="price" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" required>
                </div>

                
                <div class="mb-6">
                    <label for="description" class="block text-gray-300 font-medium mb-2">Product Description</label>
                    <textarea id="description" name="description" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" rows="4" required></textarea>
                </div>

                
                <div class="mb-6">
                    <label for="category" class="block text-gray-300 font-medium mb-2">Product Category</label>
                    <select id="category" name="category" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" required>
                        <option value="luxury">Luxury</option>
                        <option value="sports">Sports</option>
                        <option value="casual">Casual</option>
                        <option value="smartwatch">Smartwatch</option>
                    </select>
                </div>

                
                <div class="mb-6">
                    <label for="image" class="block text-gray-300 font-medium mb-2">Product Image</label>
                    <input type="file" id="image" name="image" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300">
                </div>

                
                <div class="mb-6">
                    <label for="stock" class="block text-gray-300 font-medium mb-2">Stock Quantity</label>
                    <input type="number" id="stock" name="stock" class="w-full p-4 bg-gray-700 text-white rounded-lg border-2 border-gray-600 focus:border-teal-500 focus:ring-2 focus:ring-teal-500 transition duration-300" required>
                </div>

                
                <button type="submit" class="w-full bg-teal-600 text-white p-4 rounded-lg font-semibold hover:bg-teal-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    Add Product
                </button>
            </form>

            <!-- Back to Dashboard -->
            <div class="text-center mt-8">
                <a href="{{ route('admin.dashboard') }}" class="text-teal-500 hover:text-teal-400 font-medium transition duration-300">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>