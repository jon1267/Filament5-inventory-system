<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'short_code'])]
class Unit extends Model
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
