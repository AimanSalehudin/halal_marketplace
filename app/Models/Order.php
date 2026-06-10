<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Ensure the model knows it can handle these fields
    protected $fillable = [
        'product_name', 
        'price', 
        'ordered_at'
    ];
}