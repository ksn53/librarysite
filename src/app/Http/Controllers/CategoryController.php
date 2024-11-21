<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        $books = $category->books()->get();
        return view ('categoryBooks', compact('books'));
    }
}
