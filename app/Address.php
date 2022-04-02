<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'street',
        'district',
        'city',
        'uf',
        'cep',
        'number',
        'complement'
    ];
}
