<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function getCart(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Fetch cart items and include the associated product details
    $cartItems = Cart::where('user_id', Auth::id())
                     ->with('product') // Assuming you have a product relationship
                     ->get();

    // Map the cart items to a response-friendly format
    $cartData = $cartItems->map(function($item) {
        return [
            'id' => (string) $item->_id, // Cast MongoDB ObjectId to string
            'product' => [
                'id' => (string) $item->product->_id,
                'name' => $item->product->name,
                'description' => $item->product->description,
                'price' => $item->product->price,
                'stock' => $item->product->stock
            ],
            'quantity' => $item->quantity,
            'total_price' => $item->quantity * $item->product->price
        ];
    });

    // Return the JSON response
    return response()->json([
        'status' => 'success',
        'message' => 'Cart fetched successfully',
        'data' => $cartData
    ], 200);
}

public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,_id', // Validates MongoDB ObjectId
        'quantity' => 'required|integer|min:1' // Ensure quantity is valid
    ]);

    $userId = Auth::id();
    $productId = $request->product_id;
    $quantity = $request->quantity;

    // Check if the product exists
    $product = Product::find($productId);

    if (!$product) {
        return response()->json([
            'status' => 'error',
            'message' => 'Product not found'
        ], 404);
    }

    if ($product->stock < $quantity) {
        return response()->json([
            'status' => 'error',
            'message' => 'Not enough stock available.'
        ], 400);
    }

    // Check if it's already in the cart
    $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        // If exists, update the quantity by adding the new quantity to the existing one
        $newQuantity = $cartItem->quantity + $quantity;
        $cartItem->update(['quantity' => $newQuantity]);
    } else {
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    // Update the product stock in the database
    $product->stock -= $quantity;
    $product->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Product added to cart successfully!',
        'data' => [
            'product_id' => (string) $productId,
            'quantity' => $quantity,
            'total_price' => $quantity * $product->price
        ]
    ], 200);
}

public function removeFromCart($id)
{
    // Find the cart item by ID
    $cartItem = Cart::where((['user_id' => Auth::id(), 'product_id' => $id]))->first();


    // If cart item exists, proceed to remove it
    if ($cartItem) {
        $product = $cartItem->product; // Get the associated product

        // Increase the stock of the product as it was removed from the cart
        $product->stock += $cartItem->quantity;
        $product->save(); 

        // Delete the cart item
        $cartItem->delete();

        // Return a success response with a message and cart item data
        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart successfully.',
            'data' => $cartItem
        ], 200);
    }

    // If the cart item doesn't exist, return an error message
    return response()->json([
        'status' => 'error',
        'message' => 'Cart item not found'
    ], 404);
}

//PRODUCTS

public function index()
{
    // Fetch all products from the database
    $products = Product::all();
    
    // Return a JSON response
    return response()->json([
        'status' => 'success',
        'message' => 'Products fetched successfully',
        'data' => $products
    ]);
}

// Fetch a specific product by ID
public function show($id)
{
    // Find the product by its ID
    $product = Product::find($id);
    
    if ($product) {
        // Return the product as JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Product found',
            'data' => $product
        ]);
    }

    // If the product is not found, return an error
    return response()->json([
        'status' => 'error',
        'message' => 'Product not found'
    ]);
}

    // Handle the checkout submission (create the order) for API
    public function checkout(Request $request)
    {
        // Validate the user's cart (ensure it's not empty)
        $cartItems = auth()->user()->cartItems;
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty.'
            ], 400);
        }

        // Calculate total price for the order
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        // Create the order in the database
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        // Create order items for each cart item
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Clear the user's cart after the order is placed
        auth()->user()->cartItems()->delete();

        // Return the order details and a success message as a JSON response
        return response()->json([
            'status' => 'success',
            'message' => 'Order placed successfully',
            'order' => $order
        ], 200);
    }

        // View user's profile
        public function viewProfile()
        {
            // Get the authenticated user
            $user = Auth::user();
    
            // Return the user's profile information in the response
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        }


}
