<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-3xl font-bold text-white mb-8">Checkout</h2>

        @foreach ($cartItems as $item)
            <div class="bg-gray-800 p-6 rounded-lg mb-4 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold text-white">{{ $item->product->name }}</h3>
                    <p class="text-gray-400">Quantity: {{ $item->quantity }}</p>
                    <p class="text-teal-400 font-semibold">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
            </div>
        @endforeach

        <div class="bg-gray-800 p-6 rounded-lg mb-4">
            <p class="text-xl text-white">Total Price: ${{ number_format($totalPrice, 2) }}</p>
        </div>

        <form action="{{ route('checkout.submit') }}" method="POST">
            @csrf
            <button type="submit" class="bg-teal-600 px-12 py-4 text-white rounded-full font-semibold hover:bg-teal-700 transition duration-300 transform hover:scale-105 inline-block shadow-lg text-lg">
                Buy Now
            </button>
        </form>
    </div>
</x-app-layout>
