<?php

namespace App\Services\Inventory;


use App\Models\Inventory\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class CategoryService 
{
    public function list(bool $show_all = false)
    {
        if ($show_all ?? false) {
            $category = Category::all();
        } else{
            $category = Category::paginate(10); 
        }

        return $category;
    }

    public function store(array $data)
    {
      return Category::create($data);
    }

    public function update(int $id , array $data )
    {
        $category = Category::findOrfail($id);
        $category->update($data);

        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrfail($id);
       return $category->delete();
    }

    public function search(Request $request)
    {
        $query = Category::query();

        if ($request->title)
            {
                $query->where('title','like' , '%'.$request->title.'%');
            }
        if ($request->code)
            {
                $query->where('code','like' , '%'.$request->code.'%');
            }
        $category = $query->paginate(10);
        return $category;
    }

}
