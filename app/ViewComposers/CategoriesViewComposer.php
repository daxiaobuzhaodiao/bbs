<?php

namespace App\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

class CategoriesViewComposer
{
    function compose(View $view)
    {
        return $view->with([
            'categories' => Category::all()
        ]);
    }
}