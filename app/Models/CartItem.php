<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Customer;

class CartItem extends Model
{
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'customer_id',
        'session_id',
        'product_id',
        'variant_id',
        'quantity'
    ];

    // Relationships
    public function variant()
    {
        // hasMany(RelatedModel::class, 'foreign_key', 'local_key')
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function product()
    {
        // hasMany(RelatedModel::class, 'foreign_key', 'local_key')
        return $this->belongsTo(Product::class, 'prod_id', 'product_id');
    }

    public function customer()
    {
        // hasMany(RelatedModel::class, 'foreign_key', 'local_key')
        return $this->belongsTo(Customer::class, 'cus_id', 'customer_id');
    }
}
