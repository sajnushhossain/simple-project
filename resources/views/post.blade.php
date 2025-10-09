<x-layout>
    <div class="container" style="padding-top: 40px;">
        <div style="max-width: 800px; margin: 0 auto;">
            
            <h1 style="font-size: 48px; margin-bottom: 20px; border: 1px solid #ccc; padding: 20px; border-radius: 10px 10px 0px 0px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $post->title }}</h1>
            
            <img style="width: 100%; margin-bottom: 20px; margin-top: -20px;" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/900x300' }}" alt="">
            <div style="border: 1px solid #ccc; padding: 20px; border-radius: 0px 0px 10px 10px;
            color: #333; line-height: 1.6; font-size: 18px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: -20px; margin-bottom: 20px;">
                {{ $post->body }}
                <!-- post info -->
                 <div style="color: #6c757d; margin-bottom: 20px; font-size: 14px; margin-top: 20px;">
                Posted on {{ $post->created_at->format('F j, Y, g:i a') }} by
                @if ($post->author)
                    <a href="#">{{ $post->author->name }}</a>
                @else
                    <span>Anonymous</span>
                @endif
            </div>
            </div>
        
        <div class="mb-20" style="margin-top: 40px; margin-bottom: 40px;">
                <a href="{{ url('/blog') }}" onclick="if (document.referrer) { history.back(); return false; }" class="btn btn-primary">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                </a>
            </div>
            </div>
        </div>
    </div>
</x-layout>