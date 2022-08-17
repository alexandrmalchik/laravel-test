<?php


namespace App\Repositories;


use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function createCategory(array $categoryArray)
    {
        return Category::create($categoryArray);
    }
    public function updateCategory(Category $category, array $categoryArray)
    {
        return $category->update($categoryArray);
    }
}
