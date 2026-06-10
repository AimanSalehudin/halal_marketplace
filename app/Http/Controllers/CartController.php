<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id) {
    $product = \App\Models\Product::findOrFail($id);
    $cart = session()->get('cart', []);
    
    $cart[$id] = [
        "name" => $product->name,
        "price" => $product->price,
        "quantity" => 1
    ];
    
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Added to cart!');
}

public function index() {
    $cart = session()->get('cart', []);
    return view('cart', compact('cart'));
}

public function checkout() {
    $cart = session()->get('cart', []);
    
    foreach($cart as $item) {
        \App\Models\Order::create([
            'product_name' => $item['name'],
            'price' => $item['price'],
            'ordered_at' => now()
        ]);
    }
    
    session()->forget('cart'); // Clear cart
    return view('checkout_success'); // Show the success screen
}
}
