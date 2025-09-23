<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';


    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options'
    ];

    /*
    Events (observers)
     saving , saved
     creating , created , updating , updated ,
     deleting , deleted , restoring , restored
    */
    protected static function booted()
    {
        static::observe(CartObserver::class); // for observers
        // static::creating(function(Cart $cart){
        //     $cart->id = Str::uuid();
        // });
    }


    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => "Anonymous",
            ]);
    }


    // public function options()
    // {
    //     return $this->hasMany(CartOption::class);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
