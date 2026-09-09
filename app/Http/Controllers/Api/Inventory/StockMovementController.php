<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Services\Inventory\StockMovementService;
use Illuminate\Http\Request;
use App\Http\Requests\Api\inventory\StockMovementRequest;

class StockMovementController extends Controller
{
    //
    protected StockMovementService $StockMovement;

    public function __construct(StockMovementService $StockMovement)
    {
        $this->StockMovement = $StockMovement ;
    }

    public function list(Request $request)
    {
        $StockMovement = $this->StockMovement->list($request->boolean('show_all'));

         return response()->json([
            'success' => true,
            'message' => 'Stock Movement retrieved successfly',
            'data' => [
               'StockMovement' => $StockMovement,
               
            ] 
            
        ],200);
    }

}
