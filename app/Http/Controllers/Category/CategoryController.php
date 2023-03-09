<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\SearchRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(SearchRequest $request):CategoryResource
    {
        return new CategoryResource(Category::search($request->all())->get());
    }

    public function store(StoreRequest $request):CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    public function show($id):CategoryResource
    {
        return new CategoryResource(Category::findOrfail($id));
    }

    public function update($id, StoreRequest $request):CategoryResource
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    public function destroy($id):JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return success();
    }
}
