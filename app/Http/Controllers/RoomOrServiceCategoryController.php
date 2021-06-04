<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomOrServiceCategoryController extends Controller
{
    public function index()
    {
        $user = $this->getLoggedInUser();
        $categories = Category::forBusiness($user->business->id)
                           ->get()
                           ->map(function(Category $category){
            unset($category->business_id);
            unset($category->user_id);
            return $category;
        });
        return response()->json($categories);
    }

    public function options()
    {
        $user = $this->getLoggedInUser();
        $categories = Category::forBusiness($user->business->id)->get(['id','name']);
        return response()->json($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $user = $this->getLoggedInUser();
        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->business_id = $user->business->id;
        $category->user_id = $user->id;
        $category->save();
        return response()->json("Your room/service category was added successfully!");
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();
        return response()->json("Your room/service category was updated successfully!");
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        $user = $this->getLoggedInUser();
        $category = Category::forBusiness($user->business->id)->find($id);
        if (!$category)
        {
            return response()->json("Room/service category with id {$id} not found in your workspace!", Response::HTTP_FORBIDDEN);
        }
        return response()->json($category);
    }
}
