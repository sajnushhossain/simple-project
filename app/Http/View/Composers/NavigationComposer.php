<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
