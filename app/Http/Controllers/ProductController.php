<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Don't forget to include the Model!

class ProductController extends Controller
{
    // 1. Show the Dashboard with all products
    public function index() 
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    // 2. Show the form to create a new product
    public function create() 
    {
        return view('create');
    }

    // 3. Save the new product to the database
    public function store(Request $request) 
    {
        // Basic security: validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        // Save to database
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_halal_certified' => true // Defaulting to true for the prototype
        ]);

        // Send the user back to the dashboard
        return redirect('/');
    }

    // 4. Delete the product
    public function destroy($id) 
    {
        // Find the product by its ID and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        // Send the user back to the dashboard
        return redirect('/');
    }

    public function filter(Request $request) {
    $category = $request->query('category');
    
    // Fetch products based on category
    $products = ($category === 'All') 
        ? Product::all() 
        : Product::where('category', $category)->get();

    // Return a partial view
    return view('partials.product-grid', compact('products'));
}
}