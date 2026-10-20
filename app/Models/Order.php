<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Order extends Model
{
    protected $fillable = [
        'invoice_code', 'customer_name', 'customer_phone', 'shiping_addres', 'total_amount', 'status',
    ];

    public function orderdetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}
