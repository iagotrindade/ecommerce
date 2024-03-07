<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Client;
use App\Models\User;
use App\Models\PurchasedProducts;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'payment_id',
        'order_city',
        'payment_type',
        'costumer_id',
        'type',
        'status',
        'total_amount',
        'shipping_amount',
        'user_id',
        'coupon_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function purchasedProducts()
    {
        return $this->hasMany(PurchasedProducts::class, 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchased_products', 'order_id', 'product_id');
    }

    public function purchasedProductAddons() {
        return $this->hasMany(PurchasedProductAddons::class);
    }
}
