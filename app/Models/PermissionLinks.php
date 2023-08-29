<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionLinks extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'permission_group_id',
        'permission_item_id',
    ];

    public function permissionsGroups() {
        return $this->hasOne(PermissionsGroups::class, 'id', 'permission_group_id');
    }

    public function permissionsItems() {
        return $this->hasMany(PermissionItems::class);
    }
}
