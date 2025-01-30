<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Set the image path relative to the public directory
        $heroImage = 'images/ROLEX.png';  // Use a relative path inside public

        // Fetch highlighted watches for the carousel (e.g., the first 5 products)
        $highlightedWatches = Product::take(5)->get();

        // Fetch all products for the rest of the page
        $products = Product::all();

        // Pass the $heroImage to the view along with the other data
        return view('home', compact('highlightedWatches', 'products', 'heroImage'));
    }
}
