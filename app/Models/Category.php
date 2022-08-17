<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at'];

//    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
}
