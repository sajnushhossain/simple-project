<x-layout>
    <div class="container" style="padding-top: 40px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 48px; margin-bottom: 20px;">{{ $post->title }}</h1>
            <div style="color: #6c757d; margin-bottom: 20px;">
                Posted on {{ $post->created_at->format('F j, Y, g:i a') }} by
                <a href="#">{{ $post->author->name }}</a>
            </div>
            <img style="width: 100%; border-radius: 5px; margin-bottom: 20px;" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/900x300' }}" alt="">
            <div>
                {{ $post->body }}
            </div>
        </div>
    </div>
</x-layout>