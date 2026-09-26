<?php

namespace App\Listeners\Api\Transactions;

use App\Events\Api\Transactions\PurchaseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurcheseListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PurchaseEvent $event): void
    {
        //
        $purchase = $event->purchase;

        foreach ($purchase->items as $item)
            {
                $item->product->increment('quantity' , $item->qty);
            }
    }
}