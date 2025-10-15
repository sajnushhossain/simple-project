<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest();

        if ($request->has('search')) {
            $posts->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $posts->paginate(10);
        
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('images', 'public');
        }

        $attributes['slug'] = Str::slug($attributes['title']);
        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, Post $post)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('images', 'public');
        }

        if ($attributes['title'] !== $post->title) {
            $attributes['slug'] = Str::slug($attributes['title']);
        }

        $post->update($attributes);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}