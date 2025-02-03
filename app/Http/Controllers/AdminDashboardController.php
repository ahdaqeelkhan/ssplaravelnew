<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch all products to display on the dashboard
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function createProduct()
    {
        
        return view('admin.addproduct');
    }

    public function addProduct(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        // Store image
        $imagePath = $request->file('image')->store('product_images', 'public');

        
        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'category' => $request->category,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully');
    }

    public function editProduct($id)
    {
        // Fetch product by ID
        $product = Product::findOrFail($id);

        
        return view('admin.editproduct', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update image if a new image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        // Update product details
        $product->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        // Find the product by ID and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully');
    }

    public function show($id)
{
    // Fetch the product by ID
    $product = Product::find($id);

    // Check if the product exists
    if (!$product) {
        return redirect()->route('dashboard')->with('error', 'Product not found.');
    }

    
    return view('productdetails', compact('product'));

}

}
