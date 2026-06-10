<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Products stats
        $products = Product::all();
        $totalProducts = $products->count();
        $halalCertified = $products->where('is_halal_certified', true)->count();
        $lowStock = $products->where('stock', '<', 20)->count();
        $totalStockValue = $products->sum(function ($p) {
            return $p->price * $p->stock;
        });

        // Category breakdown for chart
        $categoryData = $products->groupBy('category')->map->count();

        // Restaurant stats
        $totalRestaurants = Restaurant::count();
        $avgRating = round(Restaurant::avg('rating'), 1);

        // User stats
        $totalUsers = User::count();

        // Recent products (last 5)
        $recentProducts = Product::latest()->take(5)->get();

        // Low stock products
        $lowStockProducts = Product::where('stock', '<', 20)->orderBy('stock')->take(5)->get();

        return view('admin.dashboard', compact(
            'products',
            'totalProducts',
            'halalCertified',
            'lowStock',
            'totalStockValue',
            'categoryData',
            'totalRestaurants',
            'avgRating',
            'totalUsers',
            'recentProducts',
            'lowStockProducts'
        ));
    }

    // Approve halal certification (AJAX)
    public function approveCertification(Product $product)
    {
        $product->update(['is_halal_certified' => true]);
        return response()->json(['success' => true, 'message' => 'Product certified as Halal.']);
    }

    // Remove halal certification (AJAX)
    public function revokeCertification(Product $product)
    {
        $product->update(['is_halal_certified' => false]);
        return response()->json(['success' => true, 'message' => 'Halal certification revoked.']);
    }

    // Delete product (AJAX)
    public function destroyProduct(Product $product)
    {
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted.']);
    }
}
