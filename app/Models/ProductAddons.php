<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAddons extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_id'
    ];
}
