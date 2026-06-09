<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Models\Product;

// This now loads your beautiful Home page
Route::get('/', function () {
    $products = \App\Models\Product::all();
    $restaurants = \App\Models\Restaurant::all(); // Fetch restaurants
    return view('home', compact('products', 'restaurants'));
});

Route::get('/search', function (Request $request) {
    $query = $request->input('query');
    $products = Product::where('name', 'like', "%$query%")->get();
    return view('search-results', compact('products', 'query'));
    
    // LATER: You will write database logic here to filter products
});

// Move the vendor dashboard to a specific URL
Route::get('/vendor/dashboard', [ProductController::class, 'index']);

// Add this to your routes/web.php file
Route::get('/admin/dashboard', function () {
    return view('admin'); // This assumes your file is named 'admin.blade.php'
});

Route::get('/dev-links', function () {
    return '
        <div style="padding: 50px; font-family: sans-serif;">
            <h1>Navigation Helper</h1>
            <ul>
                <li><a href="/">Buyer Homepage</a></li>
                <li><a href="/vendor/dashboard">Vendor Dashboard</a></li>
                <li><a href="/admin/dashboard">Admin Dashboard</a></li>
            </ul>
        </div>
    ';
});

// Restaurant Details
Route::get('/restaurant/{id}', function ($id) {
    $restaurant = \App\Models\Restaurant::findOrFail($id);
    return "Showing details for: " . $restaurant->name; 
    // LATER: return view('restaurant.show', compact('restaurant'));
});

// Product Details
Route::get('/product/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return "Showing details for: " . $product->name;
    // LATER: return view('product.show', compact('product'));
});

// Other routes...
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);