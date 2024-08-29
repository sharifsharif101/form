<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
 

class Product extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'selected_products',
        'apple_price',
        'orange_price',
        'tomato_price',
        'other_fruit_name',
        'other_fruit_price',
    ];

    protected $casts = [
        'selected_products' => 'array',
        'apple_price' => 'decimal:2',
        'orange_price' => 'decimal:2',
        'tomato_price' => 'decimal:2',
        'other_fruit_price' => 'decimal:2',
    ];
}
