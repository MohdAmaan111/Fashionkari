<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Customer;

class Wishlist extends Model
{
    protected $primaryKey = 'wish_id';

    protected $fillable = ['customer_id', 'product_id', 'variant_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'prod_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cus_id', 'customer_id');
    }
}
