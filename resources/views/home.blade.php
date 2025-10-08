<x-layout>
    <div class="hero">
        <h1>Welcome to Simple Blog</h1>
        <p>A place to share my thoughts and ideas with the world.</p>
        <a href="/blog" class="btn-hero">Explore Blog</a>
    </div>

    <div class="featured-posts">
        <div class="container">
            <h2 style="text-align: center; font-size: 32px; margin-bottom: 40px;">Featured Posts</h2>
            <div class="grid">
                @foreach ($posts as $post)
                    <div class="card">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x300' }}" alt="...">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->body, 100) }}</p>
                            <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <a href="/blog" class="btn">Load More</a>
            </div>
        </div>
    </div>
</x-layout>