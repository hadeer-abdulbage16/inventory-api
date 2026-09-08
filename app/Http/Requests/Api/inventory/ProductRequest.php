<?php

namespace App\Http\Requests\Api\inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'barcode' => 'required|string|max:255|unique:products,barcode',
            'code' => 'required|string|max:255|unique:products,code',
            'name' => 'nullable|string|max:255',
            'qty' => 'required|numeric|max:60',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'expiry_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'tax_value' => 'required|numeric|min:5',
            'tax_percent' => 'required|min:2',
            'discount_value' => 'required|numeric|min:5',
            'discount_percent' => 'required|min:2',  
        ];
    }
}
