<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitOrderRequest extends FormRequest
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
            'items' => ['required', 'array', 'min:1'],
            'items.*' => ['required', 'array'],
            'items.*.variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id',
            ],
            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'ارسال حداقل یک آیتم برای ثبت سفارش الزامی است.',
            'items.array' => 'فرمت آیتم‌های سفارش معتبر نیست.',
            'items.min' => 'سفارش باید حداقل شامل یک محصول باشد.',

            'items.*.variant_id.required' => 'شناسه تنوع محصول الزامی است.',
            'items.*.variant_id.integer' => 'شناسه تنوع محصول باید عدد باشد.',
            'items.*.variant_id.exists' => 'تنوع محصول انتخاب شده در سیستم وجود ندارد.',

            'items.*.quantity.required' => 'تعدد محصول الزامی است.',
            'items.*.quantity.integer' => 'تعداد محصول باید عدد صحیح باشد.',
            'items.*.quantity.min' => 'تعداد محصول باید حداقل ۱ باشد.',
        ];
    }
}
