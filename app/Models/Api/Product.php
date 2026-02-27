<?php

namespace App\Models\Api;

use App\Models\Api\Currency\Divisas;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'divisa_id',
        'created_at',
        'updated_at',
    ];

    public function divisa()
    {
        return $this->belongsTo(Divisas::class);
    }
}
