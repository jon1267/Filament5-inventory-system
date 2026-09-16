<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['customer_id', 'warehouse_id', 'invoice_no', 'sale_date',
'total_amount', 'paid_amount', 'due_amount', 'status'])]
class Sale extends Model
{
    protected $casts = [
        'sale_date' => 'date',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_amount' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
