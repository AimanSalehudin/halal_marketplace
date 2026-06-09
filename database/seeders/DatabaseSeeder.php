<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product; // <--- 1. IMPORT THE PRODUCT MODEL
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Reliable Restaurant Data ---
        Restaurant::insert([
            ['name' => 'Burger Palace', 'category' => 'Fast Food', 'rating' => 4.8, 'image_url' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=600'],
            ['name' => 'Spice House', 'category' => 'Indian', 'rating' => 4.9, 'image_url' => 'https://images.unsplash.com/photo-1589302168068-964664d93cb0?w=600'],
            ['name' => 'Al-Mandi Grill', 'category' => 'Middle Eastern', 'rating' => 4.7, 'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Malay Kitchen', 'category' => 'Local Malay', 'rating' => 4.6, 'image_url' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600']
        ]);

        // --- Reliable Product Data ---
        Product::insert([
            ['name' => 'Classic Halal Burger', 'category' => 'Burgers', 'price' => 18.90, 'stock' => 45, 'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600'],
            ['name' => 'Chicken Biryani', 'category' => 'Rice Dishes', 'price' => 22.50, 'stock' => 30, 'image_url' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=600'],
            ['name' => 'Lamb Kebab', 'category' => 'Grills', 'price' => 32.00, 'stock' => 20, 'image_url' => 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=600'],
            ['name' => 'Shawarma Wrap', 'category' => 'Wraps', 'price' => 14.90, 'stock' => 60, 'image_url' => 'https://images.unsplash.com/photo-1626776822946-da4583151759?w=600'],
            ['name' => 'Nasi Lemak', 'category' => 'Rice Dishes', 'price' => 16.50, 'stock' => 40, 'image_url' => 'https://images.unsplash.com/photo-1616644872957-268e367858c8?w=600'],
            ['name' => 'Medjool Dates', 'category' => 'Fruits', 'price' => 18.50, 'stock' => 100, 'image_url' => 'https://images.unsplash.com/photo-1631024345266-9b51e5e016ed?w=600'],
            ['name' => 'Mixed Spices', 'category' => 'Pantry', 'price' => 12.00, 'stock' => 80, 'image_url' => 'https://images.unsplash.com/photo-1596040033229-a9821b369f67?w=600']
        ]);
    }
}