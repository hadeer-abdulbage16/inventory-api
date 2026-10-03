<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\SaleService;
use App\Http\Requests\Api\Transactions\SaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //
    public function __construct(SaleService $saleService)
    {
        $saleService = $this->saleService;
    }

    public function list(Request $request)
    {
        $sale = $this->saleService->list($request->boolean('show_all'));

          return response()->json([
            'success' => true,
            'message' => 'Sale retrieved successfly',
            'data' => [
               'sale' => SaleResource::collection($sale),
               
            ] 
            
        ],200);
    }

    public function store(SaleRequest $request)
    {
        $sale = $this->saleService->store($request->validate());

        return response()->json([
            'success' => true,
            'message' => 'purchase created successfly',
            'data' => [
               'purchase' => $purchase,
            ] 
            
        ],200);
    }
}
