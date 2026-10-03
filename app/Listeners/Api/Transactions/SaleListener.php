<?php

namespace App\Listeners\Api\Transactions;

use App\Events\SaleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaleListener
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
    public function handle(SaleEvent $event): void
    {
        //
        $sale = $event->sale;

        foreach ($sale->items as $item)
            {
                $item->product->decrement ('quantity' , $item->qty);
            }
    }
}
