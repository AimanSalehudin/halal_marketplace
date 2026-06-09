<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use App\Models\Product;

// This now loads your beautiful Home page
Route::get('/', function () {
    $products = Product::all(); // Fetch all products
    return view('home', compact('products')); // Pass them to the view
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

// Other routes...
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);