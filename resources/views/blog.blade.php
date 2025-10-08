<x-layout>
    <div class="container" style="padding-top: 40px;">
        <h1 style="text-align: center; font-size: 48px; margin-bottom: 40px;">Blog</h1>
        <div class="grid">
            @foreach ($posts as $post)
                <div class="card">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x300' }}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p>{{ Str::limit($post->body, 150) }}</p>
                        <a href="/post/{{ $post->slug }}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div style="background-color: #f8f9fa; padding: 10px 20px; font-size: 14px; color: #6c757d;">
                        Posted on {{ $post->created_at->format('F j, Y') }} by
                        <a href="#">{{ $post->author->name }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>