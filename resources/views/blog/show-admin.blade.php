<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold text-gray-900">{{ $blogPost->title }}</h2>
                    <h3>
                        <i class="fa-regular fa-calendar"></i>
                        {{ $blogPost->created_at->format("m/d/Y") }}
                        <i class="fa-solid fa-user-pen"></i>
                        {{ $blogPost->user->name }}
                        <i class="fa-regular fa-folder-closed"></i>
                        {{ $blogPost->category->name }}
                    </h3>

                    @include('blog.image-carousel')

                    <p><x-blog-status :status="$blogPost->status" class="my-3" /></p>
                    <div class="mt-2 prose max-w-none">{!! $blogPost->content !!}</div>
                    <x-primary-button type="button" onclick="location.href='{{ route($index, ['page' => request('page')]) }}'" class="mt-3" id="back-btn">
                        <i class="fa-solid fa-angles-left"></i> {{ __('Back') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
