<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,_id', // Validate MongoDB ObjectId
            'quantity' => 'required|integer|min:1' // Ensure quantity is valid
        ]);
        
        $userId = Auth::id(); // Get the logged-in user ID
        $productId = $request->product_id;
        $quantity = $request->quantity; // Get the quantity from the request
    
        // Get the product's current stock from the database
        $product = Product::find($productId);
    
        // Check if the requested quantity is available in stock
        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }
    
        // Check if the product is already in the cart
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
    
        if ($cartItem) {
            // If exists, update the quantity by adding the new quantity to the existing one
            $newQuantity = $cartItem->quantity + $quantity;
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Else, create a new cart entry with the selected quantity
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    
        // Update the product stock in the database
        $product->stock -= $quantity;
        $product->save(); // Save the new stock value
    
        return back()->with('success', 'Product added to cart!');
    }

    // View Cart Items
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    // Remove Item from Cart
    public function removeFromCart($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $product = $cartItem->product; // Get the product associated with the cart item

            // Increase the stock back when the product is removed from the cart
            $product->stock += $cartItem->quantity;
            $product->save(); // Save the updated stock value

            // Remove the cart item
            $cartItem->delete();
        }
        return back()->with('success', 'Item removed from cart.');
    }
}
