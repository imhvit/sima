<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sku'           => ['required', 'string', 'max:50', Rule::unique('products', 'sku')],
            'name'          => ['required', 'string', 'max:150'],
            'description'   => ['nullable', 'string', 'max:1000'],
            'sale_price'    => ['required', 'numeric', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],

            'category_id'   => ['required', 'integer', Rule::exists('categories', 'id')],
            'brand_id'      => ['required', 'integer', Rule::exists('brands', 'id')],
            'unit_id'       => ['required', 'integer', Rule::exists('units', 'id')],

            'image' => ['string', 'nullable'],
        ];
    }
}
