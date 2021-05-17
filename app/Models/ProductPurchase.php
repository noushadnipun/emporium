<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;
    protected $table = 'product_purchases';
    protected $fillable = [
        'user_id',
        'product_id',
        'date',
        'qty',
        'unit',
        'price',
        'payment_status'
    ];
}
