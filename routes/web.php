<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;

use App\Models\Product;
use App\Models\Restaurant;

/*
|--------------------------------------------------------------------------
| YOUR ORIGINAL SYSTEM (KEEP THIS)
|--------------------------------------------------------------------------
*/

// ✅ HOMEPAGE
Route::get('/', function (Request $request) {
    $category = $request->query('category');

    $products = $category
        ? Product::where('category', $category)->get()
        : Product::all();

    $restaurants = Restaurant::all();

    return view('home', compact('products', 'restaurants'));
});


// ✅ SEARCH
Route::get('/search', function (Request $request) {
    $query = $request->input('q');

    $products = Product::where('name', 'like', "%{$query}%")->get();
    $restaurants = Restaurant::where('name', 'like', "%{$query}%")->get();

    return view('search_results', compact('products', 'restaurants', 'query'));

})->name('search.results');


// ✅ DASHBOARDS
Route::get('/vendor/dashboard', [VendorController::class, 'dashboard']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

// ✅ VENDOR ACTIONS (AJAX)
Route::post('/vendor/products', [VendorController::class, 'storeProduct']);
Route::put('/vendor/products/{id}', [VendorController::class, 'updateProduct']);
Route::delete('/vendor/products/{id}', [VendorController::class, 'deleteProduct']);
Route::put('/vendor/orders/{id}/status', [VendorController::class, 'updateOrderStatus']);


// ✅ DEV LINKS
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


// ✅ RESTAURANT
Route::get('/restaurant/{id}', function ($id) {
    $restaurant = Restaurant::findOrFail($id);
    $products = Product::where('vendor_name', $restaurant->name)->get();

    return view('restaurant.show', compact('restaurant', 'products'));
});

// CONNECTED: Product Details from Buyer Perspective
Route::get('/product/{id}', [ProductController::class, 'show']);

// Product Vendor Actions & New Edit/Update Flow
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Product Details


Route::get('/products/filter', [ProductController::class, 'filter']);

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


// ✅ CART
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/checkout', [CartController::class, 'checkout']);


// ✅ ADMIN ACTIONS
Route::post('/admin/products/{product}/approve-halal', [AdminController::class, 'approveCertification']);
Route::post('/admin/products/{product}/revoke-halal', [AdminController::class, 'revokeCertification']);
Route::delete('/admin/products/{product}', [AdminController::class, 'destroyProduct']);


/*
|--------------------------------------------------------------------------
| ✅ BREEZE AUTH SYSTEM (ADD THIS, DON'T REPLACE)
|--------------------------------------------------------------------------
*/



// ✅ PROFILE ROUTES (VERY IMPORTANT)
Route::middleware('auth')->group(function () {

    // ✅ SHOW PROFILE (friend design)
    Route::get('/profile', function () {
        $user = auth()->user();
        $orders = \App\Models\Order::all();
        return view('profile.show', compact('user','orders'));
    })->name('profile.show');

    // ✅ KEEP edit/update/delete (for later use)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



// ✅ LOGIN / REGISTER (DO NOT TOUCH)
require __DIR__.'/auth.php';
