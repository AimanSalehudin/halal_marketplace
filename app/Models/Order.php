<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'product_name',
        'price',
        'quantity',
        'status',
        'vendor_name',
        'ordered_at',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
    ];
}
