<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('products.create');
    }

    public function rules(): array
    {
        return [
            'price' => ['required', 'numeric', 'min:0'],
            'divisa_id' => ['required', 'integer', 'exists:divisas,id'],
        ];
    }
}
