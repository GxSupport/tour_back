<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\SearchRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
/**
 * @group Category
 */
class CategoryController extends Controller
{
    /**
     *  Category-listi
     *  @urlParam search string nullable izlash uchun
     */
    public function index(SearchRequest $request):CategoryResource
    {
        return new CategoryResource(Category::search($request->all())->get());
    }

    /**
     *  Category yaratish
     *  @authenticated
     */
    public function store(StoreRequest $request):CategoryResource
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    /**
     *  Category ni id orqali olish
     *  @urlParam id integer required. Categoryni id si
     */
    public function show($id):CategoryResource
    {
        return new CategoryResource(Category::findOrfail($id));
    }

    /**
     *  Category yangilash(update)
     *  @urlParam id integer required. Category ni id si
     *  @authenticated
     */
    public function update($id, StoreRequest $request):CategoryResource
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     *  Category o'chirish
     *  @urlParam id integer required. Categoryni id si
     *  @authenticated
     */
    public function destroy($id):JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return success();
    }
}
