<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;


    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Material::class,
            table: 'product_materials',
            foreignPivotKey: 'product_id'
        )->withPivot('quantity');
    }

}
