<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;

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
            ['name' => 'Spice House', 'category' => 'Indian', 'rating' => 4.9, 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3RuJmUCInsyJiQe9EIoF7XpTgfKhUfV2n3w&s=600'],
            ['name' => 'Al-Mandi Grill', 'category' => 'Middle Eastern', 'rating' => 4.7, 'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Malay Kitchen', 'category' => 'Local Malay', 'rating' => 4.6, 'image_url' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600'],
            ['name' => 'Evoke Cafe', 'category' => 'Cafe', 'rating' => 4.5, 'image_url' => 'https://www.underconsideration.com/artofthemenu/project_images/evoke_PHOTO_07.jpg'],
            ['name' => 'Noorazah Caterers', 'category' => 'Catering', 'rating' => 4.8, 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxdn8ENsVVi7hiwCGke7oCT47NVg2GPOCcoQ&s=600']
        ]);

        // --- Reliable Product Data ---
        Product::insert([
            ['name' => 'Classic Halal Burger', 'category' => 'Burgers', 'price' => 18.90, 'stock' => 45, 'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600', 'rating' => 4.8, 'vendor_name' => 'Burger Palace', 'description' => 'Juicy halal-certified beef patty with fresh lettuce, tomato, and our special sauce.', 'is_halal_certified' => true],
            ['name' => 'Chicken Biryani', 'category' => 'Rice Dishes', 'price' => 22.50, 'stock' => 30, 'image_url' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?w=600', 'rating' => 4.7, 'vendor_name' => 'Spice House', 'description' => 'Aromatic rice dish with tender chicken and traditional spices.', 'is_halal_certified' => true],
            ['name' => 'Lamb Kebab', 'category' => 'Grills', 'price' => 32.00, 'stock' => 20, 'image_url' => 'https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=600', 'rating' => 4.9, 'vendor_name' => 'Al-Mandi Grill', 'description' => 'Tender lamb kebabs seasoned with Middle Eastern spices.', 'is_halal_certified' => true],
            ['name' => 'Shawarma Wrap', 'category' => 'Wraps', 'price' => 14.90, 'stock' => 60, 'image_url' => 'https://foxeslovelemons.com/wp-content/uploads/2023/06/Chicken-Shawarma-8.jpg', 'rating' => 4.6, 'vendor_name' => 'Malay Kitchen', 'description' => 'Authentic shawarma wrapped in a warm flatbread with fresh vegetables.', 'is_halal_certified' => true],
            ['name' => 'Nasi Lemak', 'category' => 'Rice Dishes', 'price' => 16.50, 'stock' => 40, 'image_url' => 'https://asianinspirations.com.au/wp-content/uploads/2019/04/R02156_Mums-NasiLemak.jpg', 'rating' => 4.5, 'vendor_name' => 'Malay Kitchen', 'description' => 'Aromatic coconut rice served with sambal, egg, and anchovies.', 'is_halal_certified' => true],
            ['name' => 'Medjool Dates', 'category' => 'Snacks', 'price' => 12.00, 'stock' => 100, 'image_url' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=600', 'rating' => 4.8, 'vendor_name' => 'Al-Mandi Grill', 'description' => 'Sweet and chewy Medjool dates, perfect for snacking.', 'is_halal_certified' => true],
            ['name' => 'Falafel Wrap', 'category' => 'Wraps', 'price' => 13.50, 'stock' => 50, 'image_url' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=600', 'rating' => 4.7, 'vendor_name' => 'Spice House', 'description' => 'Crispy falafel wrapped in a warm flatbread with fresh vegetables.', 'is_halal_certified' => true],
            ['name' => 'Halal Chicken Nuggets', 'category' => 'Snacks', 'price' => 10.00, 'stock' => 80, 'image_url' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600', 'rating' => 4.5, 'vendor_name' => 'Burger Palace', 'description' => 'Juicy halal-certified chicken nuggets, perfect for a quick snack.', 'is_halal_certified' => true],
            ['name' => 'Beef Shawarma', 'category' => 'Wraps', 'price' => 15.90, 'stock' => 35, 'image_url' => 'https://images.unsplash.com/photo-1600891964599-f61ba0e24092?w=600', 'rating' => 4.7, 'vendor_name' => 'Spice House', 'description' => 'Tender beef shawarma wrapped in a warm flatbread with fresh vegetables.', 'is_halal_certified' => true],
            ['name' => 'Grilled Chicken Salad', 'category' => 'Salads', 'price' => 19.50, 'stock' => 25, 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9Ulk5eGjGCgM2mSM0ZrRz4m_hSs6EssZ8Rw&s=600', 'rating' => 4.6, 'vendor_name' => 'Al-Mandi Grill', 'description' => 'Fresh mixed greens with grilled chicken and a tangy vinaigrette.', 'is_halal_certified' => true],
            ['name' => 'Halal Pepperoni Pizza', 'category' => 'Pizzas', 'price' => 24.00, 'stock' => 30, 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROHspWXnS9Xi0-ZRmPo0ClM0Wrv1fYWqq9eQ&s=600', 'rating' => 4.8, 'vendor_name' => 'Burger Palace', 'description' => 'Delicious halal-certified pepperoni pizza with a crispy crust.', 'is_halal_certified' => false],
            ['name' => 'Lamb Mandi', 'category' => 'Rice Dishes', 'price' => 28.00, 'stock' => 15, 'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600', 'rating' => 4.9, 'vendor_name' => 'Al-Mandi Grill', 'description' => 'Aromatic rice dish with tender lamb and traditional spices.', 'is_halal_certified' => true],
            ['name' => 'Halal Chicken Wings', 'category' => 'Snacks', 'price' => 14.00, 'stock' => 50, 'image_url' => 'https://d21klxpge3tttg.cloudfront.net/wp-content/uploads/2020/01/featured-honey-soy-chicken-wings-1024x640.jpg', 'rating' => 4.7, 'vendor_name' => 'Burger Palace', 'description' => 'Juicy halal-certified chicken wings with your choice of sauce.', 'is_halal_certified' => true],
        ]);

        // --- Demo Users ---
        $buyer = User::create([
            'name' => 'buyer123',
            'email' => 'buyer123@gmail.com',
            'password' => Hash::make('buyer123'),
            'role' => 'buyer',
            'phone' => '1234567890',
            'address' => 'Depan Kedai'
        ]);

        // Link vendor123 to Burger Palace (restaurant_id = 1)
        $vendor = User::create([
            'name' => 'vendor123',
            'email' => 'vendor123@gmail.com',
            'password' => Hash::make('vendor123'),
            'role' => 'vendor',
            'phone' => '0987654321',
            'address' => 'Dalam Kedai',
            'restaurant_id' => 1, // Burger Palace
        ]);

        $admin = User::create([
            'name' => 'admin123',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '0987654321',
            'address' => 'Luar Kedai'
        ]);

        // --- Demo Orders (for Burger Palace products) ---
        Order::insert([
            [
                'customer_name' => 'Ahmad Razak',
                'customer_email' => 'ahmad@example.com',
                'product_name' => 'Classic Halal Burger',
                'price' => 18.90,
                'quantity' => 2,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(1)->setHour(12)->setMinute(30),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'customer_name' => 'Siti Nurhaliza',
                'customer_email' => 'siti@example.com',
                'product_name' => 'Halal Chicken Wings',
                'price' => 14.00,
                'quantity' => 3,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(1)->setHour(14)->setMinute(15),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'customer_name' => 'Muhammad Iqbal',
                'customer_email' => 'iqbal@example.com',
                'product_name' => 'Halal Pepperoni Pizza',
                'price' => 24.00,
                'quantity' => 1,
                'status' => 'processing',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subHours(5),
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'customer_name' => 'Nurul Aisyah',
                'customer_email' => 'nurul@example.com',
                'product_name' => 'Classic Halal Burger',
                'price' => 18.90,
                'quantity' => 1,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(2)->setHour(19)->setMinute(45),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'customer_name' => 'Faiz Abdullah',
                'customer_email' => 'faiz@example.com',
                'product_name' => 'Halal Chicken Nuggets',
                'price' => 10.00,
                'quantity' => 4,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(3)->setHour(11)->setMinute(20),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'customer_name' => 'Aminah Hassan',
                'customer_email' => 'aminah@example.com',
                'product_name' => 'Halal Chicken Wings',
                'price' => 14.00,
                'quantity' => 2,
                'status' => 'pending',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subHours(2),
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'customer_name' => 'Zulkifli Bin Omar',
                'customer_email' => 'zulkifli@example.com',
                'product_name' => 'Classic Halal Burger',
                'price' => 18.90,
                'quantity' => 3,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(4)->setHour(13)->setMinute(10),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'customer_name' => 'Hafiz Rahman',
                'customer_email' => 'hafiz@example.com',
                'product_name' => 'Halal Pepperoni Pizza',
                'price' => 24.00,
                'quantity' => 2,
                'status' => 'completed',
                'vendor_name' => 'Burger Palace',
                'ordered_at' => now()->subDays(5)->setHour(20)->setMinute(0),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            // A few orders from other vendors (won't show in Burger Palace dashboard)
            [
                'customer_name' => 'buyer123',
                'customer_email' => 'buyer123@gmail.com',
                'product_name' => 'Chicken Biryani',
                'price' => 22.50,
                'quantity' => 1,
                'status' => 'completed',
                'vendor_name' => 'Spice House',
                'ordered_at' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'customer_name' => 'buyer123',
                'customer_email' => 'buyer123@gmail.com',
                'product_name' => 'Lamb Kebab',
                'price' => 32.00,
                'quantity' => 2,
                'status' => 'completed',
                'vendor_name' => 'Al-Mandi Grill',
                'ordered_at' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
