<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'image',
    ];

    public function orderdetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
