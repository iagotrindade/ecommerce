<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order_id',
        'product_id',
        'quantity',
        'purchasesProduts'
    ];


    public function purchasesProduts()
    {
        return $this->hasMany(Product::class, 'id');
    }
}
