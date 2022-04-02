<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'permission_id',
        'user_id'
    ];
}
