<?php

namespace App\Http\View\Composers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $headerPosts = Post::whereDate('updated_at', Carbon::today())
            ->orderBy('created_at', 'asc')
            ->take(3)
            ->get();

        if ($headerPosts->isEmpty()) {
            $latestPostDate = Post::max('created_at');
            if ($latestPostDate) {
                $headerPosts = Post::whereDate('created_at', Carbon::parse($latestPostDate)->toDateString())
                    ->orderBy('created_at', 'asc')
                    ->take(3)
                    ->get();
            }
        }

        $view->with('headerPosts', $headerPosts ?? collect());
    }
}
