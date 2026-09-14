<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name', 'email', 'phone', 'address', 'status')]
class Customer extends Model
{
    protected $casts = [
        'status' => 'boolean'
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
