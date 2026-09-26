<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\PurchaseService;
use App\Http\Requests\Api\Transactions\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function  __construct(protected PurchaseService $purchaseService) {
      $this->purchaseService = $purchaseService ;
    }

    public function list(Request $request)
    {
        $purchase = $this->purchaseService->list($request->boolean('show_all'));

        return response()->json([
            'success' => true,
            'message' => 'purchase retrieved successfly',
            'data' => [
               'purchase' => $purchase,
               
            ] 
            
        ],200);
    }

    public function store(PurchaseRequest $request)
    {
        $createPurchase = $this->purchaseService->store($request->validated());
         return response()->json([
            'success' => true,
            'message' => 'purchase created successfly',
            'data' => [
               'purchase' => $purchase,
            ] 
            
        ],200);
    }




}
