<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Global Scope Methode
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
    }

    // local scope : get Active products only
    protected function scopeActive(Builder $builder)
    {
        $builder->where('status', "=", 'active');
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

    //______________________[[[ Accessors ]]]______________________

    // public function get...Attribute(){}
    public function getImageUrlAttribute()
    { #use it like this  : $product->image_url

        if (! $this->image  || Str::startsWith($this->image, ['http://', 'https://']))
            return asset('assets/images/products/noImage.jpg');
        // if (Str::startsWith($this->image, ['http://', 'https://']))
        //     return $this->image;
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price)
            return 0;
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
    public function getNewAttribute(): bool
    {
        return $this->created_at > now();
    }
}
