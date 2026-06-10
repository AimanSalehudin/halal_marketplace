<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Included Model

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
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_halal_certified' => true // Defaulting to true for the prototype
        ]);

        return redirect('/');
    }

    // NEW CONTENT -> 4. Show individual item dashboard from buyer perspective
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Fetch recommendations matching this item's category (excluding itself)
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Looks directly for resources/views/product_detail.blade.php in your flat structure
        return view('product_detail', compact('product', 'relatedProducts'));
    }

    // NEW CONTENT -> 5. Show edit form prefilled with product data
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        // Reuses your flat create view but passes the product data to populate fields
        return view('create', compact('product'));
    }

    // NEW CONTENT -> 6. Update the product information in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('/');
    }

    // 7. Delete the product
    public function destroy($id) 
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/');
    }
}