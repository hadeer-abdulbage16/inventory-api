<?php

namespace App\Http\Requests\Api\Transactions;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'invoice_number' => 'required|numric|max:255',
           'invoice_date' => 'required|max:255',
           'total_amount' => 'required|numric|max:255|min:1',
           'notes' => 'string|min:3|max:500',
           'items' => 'required|array|min:1',
           'items.*.product_id' => 'required|exists:product,id',
           'items.*.product_code' => 'required|exists:product,code',
           'items.*.product_name' => 'required|exists:product,name',
           'items.*.barcode' => 'required|exists:product,barcode',
           'items.*.qty' => 'required|min:1|max:10|numric',
           'items.*.expiry_date' => 'required|date',
           'items.*.price' => 'required|numric|min:5|max:15',
           'items.*.sale_id' => 'required|exists:sales,id'
        ];
    }
}
