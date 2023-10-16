<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Material extends Model
{
    use HasFactory;


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_materials');
    }

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'material_id', 'id');
    }
}
