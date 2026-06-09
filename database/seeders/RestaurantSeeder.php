<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \DB::table('restaurants')->insert([
        ['name' => 'Burger Palace', 'category' => 'Fast Food', 'rating' => 4.8],
        ['name' => 'Spice House', 'category' => 'Indian / Pakistani', 'rating' => 4.9],
        ['name' => 'Al-Mandi Grill', 'category' => 'Middle Eastern', 'rating' => 4.7],
    ]);
}
}
