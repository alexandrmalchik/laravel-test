<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function createProduct(array $productDetails);
    public function updateProduct(Product $product, array $productDetails);
    public function getFilteredProducts(array $params);
}
