<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'sku', 'symbology', 'brand_id', 'category_id', 'unit_id',
        'price', 'qty', 'alert_qty', 'tax_method', 'tax_id', 'has_stock',
        'has_expired_date', 'expired_date', 'details', 'is_active'
    ];

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the unit that owns the product.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the tax that owns the product.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
    /**
     * Get the quantities associated with the product.
     */
    public function quantities()
    {
        return $this->hasMany(ProductQuantity::class);
    }
    // Define the inverse of the polymorphic relationship
    public function productAttachments()
    {
        return $this->morphMany(ProductAttachment::class, 'attachmentable');
    }
}
