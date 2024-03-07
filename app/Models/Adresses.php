<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Adresses extends Model
{
    use HasFactory;

    protected $fillable = [
        "cep",
        "address",
        "complement",
        "user_id"
    ];

    public function address()
    {
        return $this->belongsTo(User::class);
    }
}
