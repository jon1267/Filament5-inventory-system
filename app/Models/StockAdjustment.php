<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'warehouse_id', 'type', 'quantity', 'reason', 'adjusted_by',])]
class StockAdjustment extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function adjustedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adjusted_by');
    }
}
