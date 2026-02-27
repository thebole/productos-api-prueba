<?php

namespace App\Models\Api\Currency;

use Illuminate\Database\Eloquent\Model;

class Divisas extends Model
{
    protected $table = 'divisas';

    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
    ];
}
