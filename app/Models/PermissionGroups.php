<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\models\PermissionGroups;

class PermissionGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function usersWith() {
        return $this->hasOne(User::class, 'permission_id', 'id');
    }
}
