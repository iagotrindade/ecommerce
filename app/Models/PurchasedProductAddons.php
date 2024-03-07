<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAddons;

class PurchasedProductAddons extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'addons_price',
        'product_id',
        'order_id',
        'product_addons_id',
        'product_id'
    ];

    public function addon()
    {
        return $this->belongsTo(ProductAddons::class, 'product_addons_id');
    }
}
