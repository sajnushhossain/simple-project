<x-layout>
    <div class="max-w-[1200px] mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Post Content -->
            <main class="lg:col-span-2 ">
                <article class="bg-white rounded-lg overflow-hidden px-4 py-4">
                    <!-- Category Badge -->
                    @if($post->category)
                    <span class="inline-block bg-prothomalo-red text-black text-sm font-bold px-3 py-1 rounded-full">
                        {{ $post->category->name }}
                    </span>
                    @endif                   
                    <!-- Title -->
                    <h1 class="font-serif text-3xl md:text-4xl text-prothomalo-dark-gray mb-4 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-prothomalo-muted text-sm mb-6 pb-4 border-b border-prothomalo-border">
                        <div class="flex items-center">
                            <i class="far fa-calendar-alt mr-1"></i>
                            <span>{{ $post->created_at->format('F j, Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-1"></i>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        @if ($post->user)
                        <div class="flex items-center">
                            <i class="far fa-user mr-1"></i>
                            <span>By <i
                                    class="text-prothomalo-red hover:underline font-semibold">{{ $post->user->name }}</i></span>
                        </div>
                        @endif
                    </div>

                    <!-- Featured Image -->
                    <div class="relative mb-6 aspect-video">
                        <img class="w-full h-full object-cover rounded-lg"
                            src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/1200x675/f1f1f1/333333?text=Article+Image' }}"
                            alt="{{ $post->title }}">
                    </div>
                    <!-- Advertise -->
                     <x-ad-unit position="content-middle" />

                    <!-- Post Body -->
                    <div class="prose prose-lg max-w-none text-prothomalo-dark-gray leading-relaxed mb-8">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    <!-- Share & Back Button -->
                    <div
                        class="mt-8 pt-6 border-t border-prothomalo-border flex flex-wrap items-center justify-between gap-4">
                        <a href="/"
                            class="inline-flex items-center px-5 py-2 bg-prothomalo-red text-white font-semibold rounded-full hover:bg-red-700 transition-all duration-300 shadow-md" style="background-color: #ee1414ff; !important;">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Homepage
                        </a>

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-3">
                            <span class="text-prothomalo-muted font-semibold">Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="w-9 h-9 rounded-full bg-prothomalo-gray flex items-center justify-center text-prothomalo-dark-gray hover:bg-prothomalo-red hover:text-red transition-all duration-300" style="color: #f33636ff; !important;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                                target="_blank"
                                class="w-9 h-9 rounded-full bg-prothomalo-gray flex items-center justify-center text-prothomalo-dark-gray hover:bg-prothomalo-red hover:text-red transition-all duration-300" style="color: #f33636ff; !important;">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}&summary={{ urlencode(Str::limit(strip_tags($post->body), 150)) }}"
                                target="_blank"
                                class="w-9 h-9 rounded-full bg-prothomalo-gray flex items-center justify-center text-prothomalo-dark-gray hover:bg-prothomalo-red hover:text-red transition-all duration-300" style="color: #f33636ff; !important;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </main>

            <!-- Sidebar for Related Posts -->
            <aside class="lg:col-span-1">
                <div class="bg-prothomalo-white rounded-lg p-6 shadow-sm sticky top-24">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-newspaper text-prothomalo-red text-xl mr-3"></i>
                        <h3 class="font-serif text-xl text-prothomalo-dark-gray">Related Stories</h3>
                    </div>
                    <div class="space-y-5">
                        @forelse($relatedPosts as $related)
                        <div class="group">
                            <a href="/post/{{ $related->slug }}" class="flex gap-4">
                                <div class="flex-shrink-0 overflow-hidden rounded-md w-24 h-16">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/96x64/e5e5e5/333333?text=Post' }}"
                                        alt="{{ $related->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                </div>
                                <div class="flex-1">
                                    <h4
                                        class="font-serif text-base text-prothomalo-dark-gray group-hover:text-prothomalo-red transition-colors duration-300 line-clamp-2 mb-1">
                                        {{ Str::limit($related->title, 70) }}
                                    </h4>
                                    <div class="flex items-center text-xs text-prothomalo-light-text">
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $related->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @if(!$loop->last)
                        <div class="border-b border-prothomalo-border"></div>
                        @endif
                        @empty
                        <p class="text-prothomalo-muted text-center py-4">No related stories available.</p>
                        @endforelse
                    </div>

                    <!-- View All Button -->
                    <div class="mt-6 pt-6 border-t border-prothomalo-border">
                        <a href="/blog"
                            class="block text-center px-4 py-2 bg-prothomalo-red text-white font-semibold rounded-full hover:bg-red-700 transition-colors duration-300" style="background-color: #ee1414ff; !important;">
                            View All Articles
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </aside>
            
        </div>
    </div>
    <!-- Advertisement Section-->
                     <x-ad-unit position="content-middle" />
</x-layout>