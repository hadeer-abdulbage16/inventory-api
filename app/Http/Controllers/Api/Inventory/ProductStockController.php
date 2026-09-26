<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Services\Inventory\ProductStockService;
use App\Http\Resources\ProductStockResource;
use Illuminate\Http\Request;
use App\Http\Requests\Api\inventory\ProductStockRequest;

class ProductStockController extends Controller
{
    //
    protected ProductStockService $productStock;

    public function __construct(ProductStockService $productStock)
    {
        $this->productStock = $productStock ;
    }

    public function list(Request $request)
    {
        $products = $this->productStock->list($request->boolean('show_all'));

         return response()->json([
            'success' => true,
            'message' => 'product retrieved successfly',
            'data' => [
               'product' =>  ProductStockResource::collection($products)
               
            ] 
            
        ],200);
    }

    public function store(ProductStockRequest $request)
    {
        $product = $this->productStock->store($request->validated());

         return response()->json([
            'success' => true,
            'message' => 'product created successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);

    }
    public function update(ProductStockRequest $request , int $id )
    {
        $product = $this->productStock->update($request->validated() , $id );
        return response()->json([
            'success' => true,
            'message' => 'product updated successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);
    }
    public function delete(int $id)
    {
        $product = $this->productStock->delete($id);
         return response()->json([
            'success' => true,
            'message' => 'product deleted successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);
    }

    public function search(Request $request)
    {
        $product = $this->productStock->search($request->all());
         return response()->json([
            'success' => true,
            'message' => 'product found successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);

    }

}
