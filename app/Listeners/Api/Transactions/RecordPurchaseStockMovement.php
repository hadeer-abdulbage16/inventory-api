<?php

namespace App\Listeners\Api\Transactions;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Api\Transactions\PurchaseCompletedEvent;
use App\Services\Inventory\StockMovementService;

class RecordPurchaseStockMovement
{
    /**
     * Create the event listener.
     */
    public function __construct(protected StockMovementService $stockMovementService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PurchaseCompletedEvent $event): void
    {
        //
        $this->$stockMovementService->record([
            'product_id'  => $event->productId,
            'ref_id'      => $event->purchaseId,
            'movement'    => 'in',
            'qty'         => $event->qty,
            'ref_number'  => $event->refNumber,
            'ref_type'    => 'purchase',
            'cost_price'  => $event->costPrice,
           // 'store_id'    => $event->storeId,
            'notes'       => $event->notes,
        ]);

    }
}
