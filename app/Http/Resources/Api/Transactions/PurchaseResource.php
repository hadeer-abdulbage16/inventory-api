<?php

namespace App\Http\Resources\Api\Transactions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'invoice_number' => $this->invoice_number,
            'invoice_date' => $this->invoice_date,
            'total_amount' => (float) $this->total_amount,
            'notes' => $this->notes,
            'items' => $this->items()->map(function ($items){
                return   [
                    'product_code' => $items->product_code,
                    'product_name' => $items->product_name,
                    'qty' => $items->qty,
                    'price' => (float) $items->price,
                    'expiry_date' => $items->expiry_date?->format('Y-m-d')
                ];
                
            }),
        ];
    }
}
