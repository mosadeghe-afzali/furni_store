<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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
            'category' => 'nullable|string|exists:categories,slug',
            'status' => 'nullable|integer',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
            'has_inventory' => 'nullable|in:0,1',
            'color' => 'string|exists:attribute_values,value',
            'order_by' => 'nullable|string|in:price_asc,price_desc,created_at_asc,created_at_desc',
            'page' => 'sometimes|integer|min:1',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ];
    }
}
