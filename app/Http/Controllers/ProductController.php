<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function list(SearchProductRequest $request): JsonResponse
    {
        $products = Product::query();

        if ($request->product_name) {
            $products->where("name", "like", "%{$request->product_name}%");
        }
        if ($request->cost_start) {
            $products->where("cost", ">=", $request->cost_start);
        }
        if ($request->cost_end) {
            $products->where("cost", "<=", $request->cost_end);
        }
        if ($request->published) {
            $products->where("cost", "=", $request->published);
        }
        if ($request->category_name) {
            $category_name = $request->category_name;

            $products->whereHas('categories', function ($query) use($category_name) {
                $query->where("name", "like", "%{$category_name}%");
            });
        }

        return self::responseData(true, false, new ProductCollection($products->get()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return self::responseData(true, false, new ProductResource($product), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function create(StoreProductRequest $request): JsonResponse
    {
        $created_product = $this->productRepository->createProduct($request->validationData());

        return self::responseData(true, false, new ProductResource($created_product), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest  $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Product $product, UpdateProductRequest $request): JsonResponse
    {
        try {
            $this->productRepository->updateProduct($product, $request->validationData());
        } catch (\Exception $exception) {
            return self::responseData(false, true, $exception->getMessage(), 500);
        }

        return self::responseData(true, false, new ProductResource($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function delete(Product $product): JsonResponse
    {
        try {
            $product->delete();
        } catch (\Exception $exception) {
            return self::responseData(false, true, $exception->getMessage(), 500);
        }

        return self::responseData(true, false, 0, 200);
    }
}
