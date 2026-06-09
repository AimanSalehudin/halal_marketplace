<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // Add this line to allow Tinker to insert data into these columns
    protected $fillable = ['name', 'category', 'price', 'stock', 'is_halal_certified'];
}
