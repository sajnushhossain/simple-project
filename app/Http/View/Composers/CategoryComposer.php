<?php

namespace App\Http\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view)
    {
        $view->with('headerPosts', Post::latest()->take(3)->get());
    }
}
