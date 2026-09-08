<?php

namespace App\Http\Requests\Api\inventory;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStockRequest extends FormRequest
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
            'barcode' => 'required|max:255',
            'product_code' => 'required|string|max:255|exists:products,code',
            'product_name' => 'required|string|max:255|exists:products,name',
            'product_id' => 'required|integer|exists:products,id',
            'unit' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'expiry_date' => 'nullable|string|max:255',
            'sale_price' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'min_purchase_quantity' => 'nullable|integer',
            'min_sale_quantity' => 'nullable|integer',
            'alert_quantity' => 'nullable|integer'
        ];
    }
}
