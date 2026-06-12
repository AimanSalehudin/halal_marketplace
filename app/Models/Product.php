<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'is_halal_certified',
        'image_url',
        'vendor_name',
        'rating',
        'description',
    ];

    /**
     * Get the restaurant this product belongs to (via vendor_name).
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'vendor_name', 'name');
    }
}
