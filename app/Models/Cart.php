<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mongodb'; 
    protected $collection = 'carts'; 

    protected $fillable = [
        'user_id',  
        'product_id', 
        'quantity'
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
