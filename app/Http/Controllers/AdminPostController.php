<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'desc');
        $posts = Post::orderBy('created_at', $sort);

        if ($request->has('search')) {
            $posts->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $posts = $posts->paginate(10);
        
        return view('admin.posts.index', [
            'posts' => $posts,
            'sort' => $sort,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        Log::info('Post creation request received', $request->all());
        try {
            $attributes = $request->validated();
            if ($request->hasFile('image')) {
                $attributes['image'] = $request->file('image')->store('images', 'public');
            }
            $slug = Str::slug($attributes['title']);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count > 0) {
                $attributes['slug'] = "{$slug}-{$count}";
            } else {
                $attributes['slug'] = $slug;
            }

            $attributes['user_id'] = auth()->id();

            Post::create($attributes);

            return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Post creation validation failed', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating post', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error creating post: ' . $e->getMessage());
        }
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $attributes = $request->validated();

        if ($request->boolean('remove_image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $attributes['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $attributes['image'] = $request->file('image')->store('images', 'public');
        }

        if (isset($attributes['title']) && $attributes['title'] !== $post->title) {
            $slug = Str::slug($attributes['title']);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count > 0) {
                $attributes['slug'] = "{$slug}-{$count}";
            } else {
                $attributes['slug'] = $slug;
            }
        }

        $post->update($attributes);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }

    
}