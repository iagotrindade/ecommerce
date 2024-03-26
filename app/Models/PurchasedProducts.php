<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchasedProductAddons;
use App\Models\PurchasedProduct;
use App\Models\Product;

class PurchasedProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order_id',
        'product_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }

    public function productAddons()
    {
        return $this->hasMany(PurchasedProductAddons::class, 'product_id', 'product_id');
    }
}
