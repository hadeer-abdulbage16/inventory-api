<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProductStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
       return [
        'product_code' => $this->product_code,
        'product_name' => $this->product_name,
        'expiry_date' => Carbon::parse($this->expiry_date)->format('Y-m-d'),
        "quantity" => $this->quantity,
        'price' => $this->price
       ];
    }
}
