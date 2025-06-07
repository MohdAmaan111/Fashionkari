<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'image',
        'size',
        'stock',
        'mrp',
        'selling_price',
    ];

    // Relationship: variant belongs to product
    public function product()
    {
        // 'product_id' in this table, 'prod_id' is primary key in products
        return $this->belongsTo(Product::class, 'product_id', 'prod_id');
    }
}
