<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the product from the database
        $product = Product::find($validated['product_id']);
        
        // Check if there's enough stock
        if ($product->stock < $validated['quantity']) {
            return redirect()->back()->withErrors('Not enough stock for this product.');
        }

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',  // You can change this as per your logic
            'total_price' => $product->price * $validated['quantity'],
        ]);

        // Create order items (product details)
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'price' => $product->price,
        ]);

        // Update the product stock
        $product->stock -= $validated['quantity'];
        $product->save();

        // Redirect to order confirmation or success page
        return redirect()->route('checkout.success');
    }
}

