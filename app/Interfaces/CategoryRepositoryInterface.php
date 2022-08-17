<?php


namespace App\Interfaces;


use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function createCategory(array $categoryArray);
    public function updateCategory(Category $category, array $categoryArray);
}
