<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryCart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'inventory_id',
        'cart_id',
        'total_value_products',
        'quantity'
    ];
}
