<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-half-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6">
                    <x-primary-button type="button" id="exportModalButton" class="mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#bloggerExportModal">
                        <i class="fa-solid fa-download"></i> {{ __('Export') }}
                    </x-primary-button>
                </div>
                @include('partials._search_my_blog_posts')
                <div class="p-6 text-gray-900">
                    @unless(count($blogPosts) == 0)
                        {{ $blogPosts->links() }}
                        @foreach($blogPosts as $blogPost)
                            <div class="p-4 my-4 bg-gray-25 border border-gray-200 rounded-lg">
                                <h2 class="text-2xl font-semibold text-gray-900">
                                    <a href="{{ route('blog.showBlogger', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}" title="Read full article"
                                       class="text-laravel hover:text-laravel-light">
                                        {{ $blogPost->title }}
                                    </a>
                                </h2>
                                <h3>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $blogPost->created_at->format("m/d/Y") }}
                                    <i class="fa-solid fa-user-pen"></i>
                                    <a href="{{ route('blog.index', ['author' => $blogPost->user->name]) }}"
                                       title="More posts by {{ $blogPost->user->name }}"
                                       class="text-laravel hover:text-laravel-light">
                                        {{ $blogPost->user->name }}
                                    </a>
                                    <i class="fa-regular fa-folder-closed"></i>
                                    <a href="{{ route('blog.index', ['category' => $blogPost->category->name]) }}"
                                       title="More posts in {{ $blogPost->category->name }}"
                                       class="text-laravel hover:text-laravel-light">
                                        {{ $blogPost->category->name }}
                                    </a>
                                </h3>
                                <div class="mt-4 text-gray-600 prose max-w-none">{!! Str::limit($blogPost->content, 300) !!}</div>
                                <p class="mt-4">
                                    <x-primary-button onclick="history.back()" class="back-btn">
                                        <i class="fa-solid fa-angles-left"></i> {{ __('Back') }}
                                    </x-primary-button>
                                    <x-primary-button onclick="location.href='{{ route('blog.showBlogger', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}'" class="view-btn">
                                        <i class="fa-regular fa-eye"></i> {{ __('View') }}
                                    </x-primary-button>
                                    @if($blogPost->status == 'draft' || $blogPost->status == 'rejected')
                                        <x-primary-button onclick="location.href='{{ route('blog.edit', ['blogPost' => $blogPost->id, 'page' => $blogPosts->currentPage()]) }}'" class="edit-btn">
                                            <i class="fa-solid fa-pen"></i> {{ __('Edit') }}
                                        </x-primary-button>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                        {{ $blogPosts->links() }}
                    @else
                        <p>No blog posts found</p>
                    @endunless
                </div>
            </div>
        </div>
    </div>
    @include('blog.blogger-export-modal')
    <!--
    <script type="module">
        Echo.private('export.' + {{ auth()->id() }})
            .listen('ExportCompleted', (event) => {
                console.log('Export completed:', event);
            });
    </script>
    -->
</x-app-layout>
