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
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|integer',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
            'in_stock' => 'nullable|in:0,1',
            'attribute_values' => 'nullable|array',
            'attribute_values.*' => 'integer|exists:attribute_values,id',
            'order_by' => 'nullable|string|in:price_asc,price_desc,created_at_asc,created_at_desc',
        ];
    }
}
