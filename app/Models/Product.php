<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchasedProductAddons;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_id',
        'status',
        'price',
        'quantity',
        'discount_status',
        'discount',
        'categories_id'
    ];

    public function image() {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function purchases()
    {
        return $this->belongsTo(PurchasedItems::class, 'order_id');
    }

    public function purchasedAddons() {
        return $this->hasMany(PurchasedProductAddons::class);
    }

    public function addons() {
        return $this->hasMany(ProductAddons::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'id');
    }
}
