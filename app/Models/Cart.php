<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'carts'; // Collection name

    protected $fillable = [
        'user_id',  // The ID of the logged-in user
        'product_id', 
        'quantity'
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
