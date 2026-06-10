<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'category', 'rating', 'image_url'];
    // app/Models/Restaurant.php
public function products() {
    return $this->hasMany(Product::class, 'vendor_name', 'name');
}
}
