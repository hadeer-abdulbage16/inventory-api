<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\inventory\ProductRequest;
use App\Services\Inventory\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected ProductService $productService; 
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function list(Request $request)
    {
        $product = $this->productService->list($request->boolean('show_all'));

         return response()->json([
            'success' => true,
            'message' => 'product retrieved successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->store($request->validated());

         return response()->json([
            'success' => true,
            'message' => 'product created successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);

    }
    public function update(productRequest $request , int $id)
    {
        $product = $this->productService->update($id, $request->validated());
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
        $product = $this->productService->delete($id);
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
        $product = $this->productService->search($request->all());
         return response()->json([
            'success' => true,
            'message' => 'product found successfly',
            'data' => [
               'product' => $product,
               
            ] 
            
        ],200);

    }
}
