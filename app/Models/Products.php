<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id'; // Define the primary key column
    protected $fillable = [
        'product_name',
        'price',
        'quantitystock',
        'category',
        'discount',
        'product_image',
    ];
}
