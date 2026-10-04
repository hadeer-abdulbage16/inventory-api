<?php

namespace App\Http\Controllers\Api\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\SaleService;
use App\Http\Requests\Api\Transactions\SaleRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Transactions\saleResource;

class SaleController extends Controller
{
    //
    public function __construct(protected SaleService $saleService)
    {
         $this->saleService = $saleService ;
    }

    public function list(Request $request)
    {
        $sale = $this->saleService->list($request->boolean('show_all'));

          return response()->json([
            'success' => true,
            'message' => 'Sale retrieved successfly',
            'data' => [
               'sale' => saleResource::collection($sale),
               
            ] 
            
        ],200);
    }

    public function store(SaleRequest $request)
    {
        $sale = $this->saleService->store($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'sale created successfly',
            'data' => [
               'sale' => $sale,
            ] 
            
        ],200);
    }
}
