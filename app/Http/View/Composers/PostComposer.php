<?php

namespace App\Http\View\Composers;

use App\Models\Post;
use Illuminate\View\View;

class PostComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('posts', Post::all());
    }
}