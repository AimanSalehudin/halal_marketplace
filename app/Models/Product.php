<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // app/Models/Product.php
protected $fillable = [
    'name', 
    'category', 
    'price', 
    'stock', 
    'is_halal_certified', 
    'image_url' // <--- MUST be here
];}
