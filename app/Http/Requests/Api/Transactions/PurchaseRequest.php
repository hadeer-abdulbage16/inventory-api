<?php

namespace App\Http\Requests\Api\Transactions;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
           'invoice_number' => 'required|max:1300000',
           'invoice_date' => 'required|max:255',
           'total_amount' => 'max:255|min:1',
           'notes' => 'string|min:3|max:500',
           'items' => 'required|array|min:1',
           'items.*.product_id' => 'required|exists:products,id',
           'items.*.product_code' => 'required|exists:products,code',
           'items.*.product_name' => 'required|exists:products,name',
           'items.*.barcode' => 'required|exists:products,barcode',
           'items.*.qty' => 'required|min:1|max:10',
           'items.*.expiry_date' => 'required|date',
           'items.*.price' => 'required|min:1|max:15',
           'items.*.purchase_id' => 'exists:purchases,id'
        ];
    }
}
