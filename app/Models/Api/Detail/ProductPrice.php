<?php

namespace App\Models\Api\Detail;

use App\Models\Api\Currency\Divisas;
use App\Models\Api\Product;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    //
    protected $table = 'products_prices';

    protected $fillable = [
        'product_id',
        'price',
        'divisa_id',
        'created_at',
        'updated_at',
    ];


    public function divisa()
    {
        return $this->belongsTo(Divisas::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
