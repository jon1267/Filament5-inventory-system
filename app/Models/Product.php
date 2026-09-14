<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name', 'slug', 'sku', 'category_id', 'unit_id',
    'cost_price', 'selling_price', 'image', 'description', 'status',)]
class Product extends Model
{
    protected $casts = [
        'status' => 'boolean',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
    public function stockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class);
    }

    // Helper: total stock across all warehouses
    public function totalStock()
    {
        return $this->stocks()->sum('quantity');
    }
}
