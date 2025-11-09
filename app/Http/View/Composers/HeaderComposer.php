<?php

namespace App\Http\View\Composers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $view->with('headerPosts', Post::whereDate('created_at', Carbon::today())
                                ->orderBy('created_at', 'asc')
                                ->take(3)
                                ->get());
    }
}
