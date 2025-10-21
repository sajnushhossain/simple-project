<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(10)->get();
        $categories = Category::with(['posts' => function ($query) {
            $query->latest('updated_at')->take(3);
        }])->get();

        return view('home', compact('posts', 'categories'));
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
        $relatedPosts = Post::where('id', '!=', $post->id)->inRandomOrder()->take(5)->get();

        return view('post', compact('post', 'relatedPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::query();

        if ($query) {
            $posts->where('title', 'like', "%{$query}%");
        }

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->input('category'))->first();
            if ($category) {
                $posts->where('category_id', $category->id);
            }
        }

        if ($request->filled('date')) {
            $posts->whereDate('created_at', $request->input('date'));
        }

        $posts = $posts->paginate(9);
        $categories = Category::all();

        return view('search', compact('posts', 'query', 'categories'));
    }
}
