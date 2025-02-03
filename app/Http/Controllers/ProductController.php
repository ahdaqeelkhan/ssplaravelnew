<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all();
        
        return view('products.index', compact('products'));
    }
}
