<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Global Scope Methode
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function store(): BelongsTo
    {
        return $this->belongsTo(store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',  #pivot Table
            'product_id',  # fk for current model
            'tag_id',   # fk for related model
            'id', # pk current model
            'id' # pk related model
        );
    }

}
