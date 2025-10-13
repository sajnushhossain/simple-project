@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col items-center justify-center space-y-4">
        <div class="flex justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-500 bg-white border-2 border-gray-300 cursor-default leading-5 rounded-lg">
                    <i class="fas fa-chevron-left mr-2"></i>{!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-white border-2 border-gray-300 leading-5 rounded-lg hover:bg-primary hover:border-primary focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200">
                    <i class="fas fa-chevron-left mr-2"></i>{!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-white border-2 border-gray-300 leading-5 rounded-lg hover:bg-primary hover:border-primary focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200">
                    {!! __('pagination.next') !!}<i class="fas fa-chevron-right ml-2"></i>
                </a>
            @else
                <span class="relative inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-500 bg-white border-2 border-gray-300 cursor-default leading-5 rounded-lg">
                    {!! __('pagination.next') !!}<i class="fas fa-chevron-right ml-2"></i>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-col sm:items-center sm:justify-center space-y-4 w-full">
            <div>
                <p class="text-sm text-gray-400 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-semibold text-primary">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-semibold text-primary">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-semibold text-primary">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse gap-2">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-2 border-gray-300 cursor-default rounded-lg leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border-2 border-gray-300 rounded-lg leading-5 hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200" aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border-2 border-gray-300 cursor-default leading-5 rounded-lg">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-primary border-2 border-primary cursor-default leading-5 rounded-lg shadow-lg">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-white border-2 border-gray-300 leading-5 hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 rounded-lg" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border-2 border-gray-300 rounded-lg leading-5 hover:bg-primary hover:text-white hover:border-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200" aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-2 border-gray-300 cursor-default rounded-lg leading-5" aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
