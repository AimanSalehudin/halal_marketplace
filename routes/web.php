<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;

// This now loads your beautiful Home page
Route::get('/', function (Request $request) {
    $category = $request->query('category');
    
    // If a category is selected, filter; otherwise, show all
    $products = $category 
        ? Product::where('category', $category)->get() 
        : Product::all();
        
    $restaurants = \App\Models\Restaurant::all();
    return view('home', compact('products', 'restaurants'));
});

Route::get('/search', function (Request $request) {
    $query = $request->input('q');

    // Search both models
    $products = Product::where('name', 'like', "%{$query}%")->get();
    $restaurants = Restaurant::where('name', 'like', "%{$query}%")->get();

    return view('search_results', compact('products', 'restaurants', 'query'));
})->name('search.results');

// Move the vendor dashboard to a specific URL
Route::get('/vendor/dashboard', [ProductController::class, 'index']);

// Add this to your routes/web.php file
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

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
    // Ensure you have a 'products' relationship in your Restaurant model
    $restaurant = \App\Models\Restaurant::findOrFail($id);
    // Fetch products that match the restaurant name (or use a restaurant_id foreign key)
    $products = \App\Models\Product::where('vendor_name', $restaurant->name)->get();
    
    return view('restaurant.show', compact('restaurant', 'products'));
});

// CONNECTED: Product Details from Buyer Perspective
Route::get('/product/{id}', [ProductController::class, 'show'])->name('buyer.product.show');

Route::get('/profile', function () {
    $user = (object)[
        'name' => 'Ahmad Bin Razak',
        'email' => 'ahmad@example.com',
        'phone' => '+60 11 3456 7890',
        'address' => 'Selangor, Malaysia'
    ];
    
    // Fetch the data
    $orders = \App\Models\Order::all();
    
    // Pass BOTH variables to the view
    return view('profile.show', compact('user', 'orders'));
})->name('profile.show');

// Other routes...
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// Cart routes
Route::post('/checkout', [CartController::class, 'checkout']);
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/admin/products/{product}/approve-halal', [AdminController::class, 'approveCertification']);
Route::post('/admin/products/{product}/revoke-halal', [AdminController::class, 'revokeCertification']);
Route::delete('/admin/products/{product}', [AdminController::class, 'destroyProduct']);
