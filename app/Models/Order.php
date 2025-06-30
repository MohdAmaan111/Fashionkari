<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'order_number',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'note',
        'shipping_method',
        'name',
        'email',
        'phone',
        'pincode',
        'state',
        'city',
        'area',
        'address_line'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_number');
    }
}
