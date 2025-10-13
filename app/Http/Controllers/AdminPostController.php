<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $posts = Post::all();
        return view('admin.posts.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image',
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
        $posts = Post::all();
        return view('admin.posts.edit', ['post' => $post, 'posts' => $posts]);
    }

    public function update(Request $request, Post $post)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image',
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
