<?php


namespace App\Repositories;


use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function createProduct(array $productDetails)
    {
        $product = Product::create($productDetails);
        $product->categories()->attach($productDetails['categories']);

        return $product;
    }
    public function updateProduct(Product $product, array $productDetails)
    {
        $product->update($productDetails);
        $product->categories()->sync($productDetails['categories']);

        return $product;
    }
    public function getFilteredProducts(array $params)
    {
        return Product::all();
    }
}
