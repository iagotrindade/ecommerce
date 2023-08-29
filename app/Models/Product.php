<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_id',
        'status',
        'price',
        'quantity'
    ];

    public function purchases()
    {
        return $this->belongsTo(PurchasedItems::class, 'order_id');
    }
}
