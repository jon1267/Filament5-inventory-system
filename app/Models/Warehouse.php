<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name', 'location', 'status')]
class Warehouse extends Model
{
    protected $casts = [
        'status' => 'boolean'
    ];

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
