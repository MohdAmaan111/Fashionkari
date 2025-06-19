<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $primaryKey = 'prod_id';

    protected $fillable = [
        'product_name',
        'product_slug',
        'category_id',
        'mrp',
        'selling_price',
        'stock',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'fabric_name',
        'brand_id',
        'age_group',
        'neck_type',
        'length_type',
        'sleeve_type',
        'fit_type',
        'care_instructions',
        'prod_description',
        'color',
        'images'
    ];

    // Relationships
    public function category()
    {
        // hasMany(RelatedModel::class, 'foreign_key', 'local_key')
        return $this->belongsTo(Category::class, 'category_id', 'cat_id');
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->product_slug = Str::slug($product->product_name . '-' . Str::random(4));
        });

        static::updating(function ($product) {
            if ($product->isDirty('product_name')) {
                $product->product_slug = Str::slug($product->product_name . '-' . Str::random(4));
            }
        });
    }

    // Relationships
    public function variants()
    {
        // hasMany(RelatedModel::class, 'foreign_key', 'local_key')
        return $this->hasMany(ProductVariant::class, 'product_id', 'prod_id');
    }
}
