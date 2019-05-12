<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category) 
    {
        $topics = $category->topics()->with('user', 'category')->paginate(10);
        return view('topics.index', compact('topics'));
    }
}
