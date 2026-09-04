<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Services\Inventory\CategoryService;
use App\Http\Requests\Api\inventory\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected CategoryService $categoryService ;
    public function __construct(CategoryService  $categoryService ) {
        $this->categoryService = $categoryService;
    }

    public function list(Request $request)
    {
       $category = $this->categoryService->list($request->boolean('show_all'));
       
        return response()->json([
            'success' => true,
            'message' => 'category retrieved successfly',
            'data' => [
               'category' => $category,
               
            ] 
            
        ],200);
        

    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->store($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'category created successfly',
            'data' => [
               'category' => $category,
               
            ] 
            
        ],201);
    }
    public function update(CategoryRequest $request , int $id)
    {
        $category = $this->categoryService->update($id, $request->validated());
        return response()->json([
            'success' => true,
            'message' => 'category updated successfly',
            'data' => [
               'category' => $category,
               
            ] 
            
        ],200);
    }

    public function delete(int $id)
    {
        $category = $this->categoryService->delete($id);
         return response()->json([
            'success' => true,
            'message' => 'category deleted successfly',
            'data' => [
               'category' => $category,
               
            ] 
            
        ],200);
    }

    public function search(Request $request)
    {
        $category = $this->categoryService->search($request);
         return response()->json([
            'success' => true,
            'message' => 'category found successfly',
            'data' => [
               'category' => $category,
               
            ] 
            
        ],200);

    }
}
