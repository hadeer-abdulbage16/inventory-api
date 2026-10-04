<?php

namespace App\Listeners\Api\Transactions;

use App\Events\Api\Transactions\SaleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Inventory\StockMovementService;

class RecordSaleStock
{
    /**
     * Create the event listener.
     */
    public function __construct(protected StockMovementService $stockMovement)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SaleEvent $event): void
    {
        //
        $this->stockMovement->record([
            'product_id'  => $event->productId,
            'ref_id'      => $event->saleId,
            'movement'    => 'out',
            'qty'         => $event->qty,
            'ref_number'  => $event->refNumber,
            'ref_type'    => 'sale',
            'cost_price'  => $event->costPrice,
            'notes'       => $event->notes,

        ]);
    }
}
