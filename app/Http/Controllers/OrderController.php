<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    // display checkout page
    public function checkoutPage()
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to proceed.');
        }

        // logged in useer cartitems
        $cartItems = auth()->user()->cartItems;
        
        // check if cart is emtpy
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        // Pass cart items and total price to the checkout page
        return view('orders.show', compact('cartItems', 'totalPrice'));
    }

    // Handle the checkout submission (create the order)
    public function checkout(Request $request)
    {
        // Validate that the cart is not empty
        $cartItems = auth()->user()->cartItems;
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear the cart after the order is placed
        auth()->user()->cartItems()->delete();

        
        return redirect()->route('order.success');
    }

    // order details page
    public function show($id)
    {
        // Fetch the order by its ID with related items and products
        $order = Order::with('items.product')->findOrFail($id);

        // Fetch the cart items for the logged-in user (if needed)
        $cartItems = auth()->user()->cartItems;

        
        return view('orders.show', compact('order', 'cartItems'));
    }
}
