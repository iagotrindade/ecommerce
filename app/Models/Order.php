<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Client;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'client_name',
        'payment_type',
        'payment_status',
        'processing_status',
        'total_amount',
        'order_city',
        'created_at',
        'coupon_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function pruchasedItems()
    {
        return $this->hasMany(PurchasedProducts::class, 'order_id');
    }
}
