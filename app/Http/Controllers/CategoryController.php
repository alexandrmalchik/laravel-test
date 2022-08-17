<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return self::responseData(true, false, new CategoryCollection(Category::all()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return self::responseData(true, false, new CategoryResource($category), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function create(StoreCategoryRequest $request): JsonResponse
    {
        $created_user = $this->categoryInterface->createCategory($request->validationData());

        return self::responseData(true, false, new CategoryResource($created_user), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param UpdateCategoryRequest $request
     * @return JsonResponse
     */
    public function update(Category $category, UpdateCategoryRequest $request): JsonResponse
    {
        try {
            $this->categoryInterface->updateCategory($category, $request->validationData());
        } catch (\Exception $exception) {
            return self::responseData(false, true, $exception->getMessage(), 500);
        }

        return self::responseData(true, false, new CategoryResource($category), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category): JsonResponse
    {
        try {
            $category->delete();
        } catch (\Exception $exception) {
            return self::responseData(false, true, $exception->getMessage(), 500);
        }

        return self::responseData(true, false, 0, 200);
    }
}
