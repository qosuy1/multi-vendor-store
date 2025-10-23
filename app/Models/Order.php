<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'number',
        'payment_method',
        'status',
        'payment_status'
    ];

    protected static function booted()
    {
        static::creating(function (Order $order) {
            // 20250001  20250002  20250003
            $order->number = Order::getNextOrderNumber();
        });

        if (auth()->user() && (auth()->user()->type == 'admin' || auth()->user()->type == 'super_admin'))

            static::addGlobalScope(function (Builder $builder) {
                $builder->where('store_id', auth()->user()->store_id);
            });
    }

    private static function getNextOrderNumber(): int
    {
        $year = Carbon::now()->year;

        // Use database lock to prevent race conditions
        return DB::transaction(function () use ($year) {
            $number = Order::lockForUpdate()
                ->whereYear('created_at', $year)
                ->max('number');

            if ($number) {
                return $number + 1;
            }

            return (int) ($year . "0001");
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(
            [
                'name' => "Guest customer",
            ]
        );
    }

    public function orderItems()
    {
        // return $this->belongsToMany(Product::class , 'order_items', 'order_id', 'product_id', 'id', 'id');
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->withPivot([
                'product_name',
                'price',
                'options',
                'quantity',
                'store_id'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }

    // public function vendorOrders()
    // {
    //     return $this->hasMany(VendorOrder::class);
    // }
}
