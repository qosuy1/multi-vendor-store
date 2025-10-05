<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
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


        // add GlobalScope to query the cookie_id every time
        static::addGlobalScope('cookie_id', function (Builder $builder) {
            $builder->where('cookie_id', Cart::getCookieId());
        });
    }

    public static function getCookieId()
    {
        $cookieId = Cookie::get('cart_id');
        if (!$cookieId) {
            $cookieId = Str::uuid();
            Cookie::queue('cart_id', $cookieId, Carbon::now()->addDays(30)->getTimestamp() - now()->getTimestamp());
            // the cookie will be deleted after 30 days , or 30 * 24 * 60
        }
        return $cookieId;
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
        return $this->belongsTo(Product::class)->withDefault([
            'name' => 'Product not available',
            'price' => 0,
        ]);
    }
}
