<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-half-screen overflow-hidden shadow-sm sm:rounded-lg">
                @include('partials._search_blog_posts')
                <div class="p-6 text-gray-900">
                    @unless(count($blogPosts) == 0)
                        {{ $blogPosts->links() }}
                        @foreach($blogPosts as $blogPost)
                            <div class="p-4 my-4 bg-gray-25 border border-gray-200 rounded-lg">
                                <h2 class="text-2xl font-semibold text-gray-900">
                                    <a href="{{ route('blog.show', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}" title="Read full article"
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
                                <p class="mt-2">
                                    <a href="{{ route('blog.show', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}" title="Read full article"
                                       class="text-laravel hover:text-laravel-light">Read more...</a>
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
</x-app-layout>
