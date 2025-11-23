<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(37)->get();
        $featured = $posts->shift();

        if (! $featured) {
            return view('home', [
                'featured' => null,
                'posts' => collect(),
                'rightGrid' => collect(),
                'threeColumn' => collect(),
                'moreNews' => collect(),
                'aboutToKnowPosts' => collect(),
                'categories' => collect(),
                'randomCategories' => collect(),
            ]);
        }

        $rightGrid = $posts->splice(0, 8);
        $threeColumn = $posts->splice(0, 3);
        $moreNews = $posts->splice(0, 11);
        $aboutToKnowPosts = $posts->splice(0, 7);

        $categories = Category::with(['posts' => function ($query) {
            $query->latest('updated_at')->take(11);
        }])->latest()->get();

        $randomCategories = Category::has('posts', '>=', 2)->inRandomOrder()->take(2)->with(['posts' => function ($query) {
            $query->latest()->take(2);
        }])->get();

        return view('home', compact('posts', 'featured', 'rightGrid', 'threeColumn', 'moreNews', 'aboutToKnowPosts', 'categories', 'randomCategories'));
    }

    public function blog(Request $request)
    {
        $posts = Post::latest();

        if ($request->has('category')) {
            $category = Category::where('slug', $request->input('category'))->firstOrFail();
            $posts->where('category_id', $category->id);
        }

        $posts = $posts->paginate(9);
        $categories = Category::all();

        return view('blog', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::with('user')->where('id', '!=', $post->id)->inRandomOrder()->take(5)->get();

        return view('post', compact('post', 'relatedPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categorySlug = $request->input('category');
        $date = $request->input('date');

        $posts = Post::query()->with('user', 'category');

        if ($query) {
            $searchTerms = explode(' ', $query); // Split query into words
            $posts->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orWhere('title', 'like', "%{$term}%")
                        ->orWhere('body', 'like', "%{$term}%");
                }
            });
        }

        if ($categorySlug) {
            $posts->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($date) {
            try {
                $parsedDate = \Carbon\Carbon::parse($date);
                $posts->whereDate('created_at', $parsedDate->toDateString());
            } catch (\Exception $e) {
                // Not a valid date, so ignore
            }
        }

        $posts = $posts->paginate(9);
        $categories = Category::all();

        return view('search', compact('posts', 'query', 'categories'));
    }
}
