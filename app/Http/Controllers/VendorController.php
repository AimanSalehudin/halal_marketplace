<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;

class VendorController extends Controller
{
    /**
     * Get the vendor user (for demo: always vendor123 / user id 2).
     * If logged in as a vendor, use that. Otherwise fallback to vendor123.
     */
    private function getVendor()
    {
        $user = auth()->user();

        if ($user && $user->role === 'vendor') {
            return $user;
        }

        // Fallback for demo: load vendor123
        return User::where('role', 'vendor')->first();
    }

    /**
     * Vendor Dashboard — main page with all sections.
     */
    public function dashboard()
    {
        $vendor = $this->getVendor();
        $restaurant = $vendor ? Restaurant::find($vendor->restaurant_id) : null;
        $vendorName = $restaurant ? $restaurant->name : 'Unknown Store';

        // Vendor's products only
        $products = Product::where('vendor_name', $vendorName)->get();

        // Stats
        $totalProducts = $products->count();
        $halalCertified = $products->where('is_halal_certified', true)->count();
        $lowStock = $products->where('stock', '<', 20)->count();
        $totalStockValue = $products->sum(function ($p) {
            return $p->price * $p->stock;
        });

        // Orders for this vendor
        $orders = Order::where('vendor_name', $vendorName)
            ->orderBy('ordered_at', 'desc')
            ->get();

        $totalRevenue = $orders->where('status', 'completed')->sum(function ($o) {
            return $o->price * $o->quantity;
        });

        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $processingOrders = $orders->where('status', 'processing')->count();

        // Category breakdown for vendor's products
        $categoryData = $products->groupBy('category')->map->count();

        // Low stock products
        $lowStockProducts = $products->where('stock', '<', 20)->sortBy('stock')->values();

        return view('vendor.dashboard', compact(
            'vendor',
            'restaurant',
            'vendorName',
            'products',
            'totalProducts',
            'halalCertified',
            'lowStock',
            'totalStockValue',
            'orders',
            'totalRevenue',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'categoryData',
            'lowStockProducts'
        ));
    }

    /**
     * Store a new product (AJAX).
     */
    public function storeProduct(Request $request)
    {
        $vendor = $this->getVendor();
        $restaurant = $vendor ? Restaurant::find($vendor->restaurant_id) : null;

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url|max:500',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description ?? '',
            'image_url' => $request->image_url ?? null,
            'vendor_name' => $restaurant ? $restaurant->name : 'Unknown Store',
            'rating' => 0.0,
            'is_halal_certified' => false, // Pending admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully!',
            'product' => $product,
        ]);
    }

    /**
     * Update an existing product (AJAX).
     */
    public function updateProduct(Request $request, $id)
    {
        $vendor = $this->getVendor();
        $restaurant = $vendor ? Restaurant::find($vendor->restaurant_id) : null;
        $vendorName = $restaurant ? $restaurant->name : 'Unknown Store';

        $product = Product::where('id', $id)->where('vendor_name', $vendorName)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url|max:500',
        ]);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description ?? $product->description,
            'image_url' => $request->image_url ?? $product->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!',
            'product' => $product->fresh(),
        ]);
    }

    /**
     * Delete a product (AJAX).
     */
    public function deleteProduct($id)
    {
        $vendor = $this->getVendor();
        $restaurant = $vendor ? Restaurant::find($vendor->restaurant_id) : null;
        $vendorName = $restaurant ? $restaurant->name : 'Unknown Store';

        $product = Product::where('id', $id)->where('vendor_name', $vendorName)->firstOrFail();
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!',
        ]);
    }

    /**
     * Update order status (AJAX).
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $vendor = $this->getVendor();
        $restaurant = $vendor ? Restaurant::find($vendor->restaurant_id) : null;
        $vendorName = $restaurant ? $restaurant->name : 'Unknown Store';

        $order = Order::where('id', $id)->where('vendor_name', $vendorName)->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated!',
        ]);
    }
}
