<?php

namespace App\Events\Api\Transactions;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inventory\StockMovement;


class PurchaseCompletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public StockMovement $stockMovement , 
        public ?string $notifyEmail = null,
        public int $productId,
        public int $purchaseId,
        public float $qty,
        public ?float $costPrice = null,
        //public ?int $storeId = null,
        public ?string $refNumber = null,
        public ?string $notes = null,)
    {
        //
         
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
