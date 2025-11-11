@props(['categories'])

<section class="mb-8 border-t border-border-light pt-8">
    <h2 class="font-serif text-3xl text-dark-text mb-6 leading-tight">From the Archives</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
        @foreach($categories as $category)
        @if($category->posts->isNotEmpty())
        <div class="border-r border-border-light pr-4 last:border-r-0 min-w-0">
            <h3 class="font-serif text-xl text-dark-text mb-4 border-b border-border-light pb-2">
                <a href="/blog?category={{ $category->slug }}" class="hover:text-primary-red">{{ $category->name }}</a>
            </h3>
            <div class="space-y-4">
                @foreach($category->posts->take(5) as $post)
                <article class="pb-4 border-b border-border-light last:border-b-0">
                    <a href="/post/{{ $post->slug }}" class="block group">
                        <h4 class="font-serif text-base text-dark-text leading-tight mb-1 group-hover:text-primary-red transition-colors line-clamp-3">
                            {{ $post->title }}
                        </h4>
                        <div class="text-xs text-light-text">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>