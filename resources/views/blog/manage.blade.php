<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Manage Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="page" value="{{ request('page') }}">

                        @include('blog.image-carousel')

                        <!-- Title -->
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="title" name="title"
                                          value="{{$blogPost->title}}" readonly />
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <x-input-label for="slug" :value="__('Slug')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="slug" name="slug"
                                          value="{{$blogPost->slug}}" readonly />
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <x-input-label for="category" :value="__('Category')"/>
                            <select id="blog_category_id" name="blog_category_id" class="block mt-1 w-full" disabled>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{ $category->id == $blogPost->blog_category_id ? 'selected' : '' }}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <x-input-label for="content" :value="__('Content')"/>
                            <!--
                            <x-textarea id="content" name="content" rows="10" readonly>{!! $blogPost->content !!}</x-textarea>
                            -->
                            <div class="mt-0 border-2 px-3 prose max-w-none">{!! $blogPost->content !!}</div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-6">
                            <x-input-label for="tags" :value="__('Tags')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="tags" name="tags"
                                          value="{{$blogPost->tags}}" readonly />
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <select id="status" name="status" class="block mt-1 w-full" disabled>
                                <option
                                    value="draft" {{ $blogPost->status == 'draft' ? 'selected' : '' }}>
                                    {{ __('Draft') }}
                                </option>
                                <option
                                    value="rejected" {{ $blogPost->status == 'rejected' ? 'selected' : '' }}>
                                    {{ __('Rejected') }}
                                </option>
                                <option
                                    value="published" {{ $blogPost->status == 'published' ? 'selected' : '' }}>
                                    {{ __('Published') }}
                                </option>
                                <option
                                    value="archived" {{ $blogPost->status == 'archived' ? 'selected' : '' }}>
                                    {{ __('Archived') }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-6">
                            @if ($blogPost->status == 'submitted')
                                <x-success-button type="button" id="openPublishModal" class="mt-7 mb-5"
                                                 data-bs-toggle="modal" data-bs-target="#publishModal">
                                    <i class="fa-solid fa-upload"></i> {{ __('Publish') }}
                                </x-success-button>
                                <x-danger-button type="button" id="openRejectModal" class="mt-7 mb-5"
                                                 data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    <i class="fa-solid fa-eject"></i> {{ __('Reject') }}
                                </x-danger-button>
                            @endif
                            @if ($blogPost->status == 'published')
                                <x-danger-button type="button" id="openArchiveModal" class="mt-7 mb-5"
                                                 data-bs-toggle="modal" data-bs-target="#archiveModal">
                                    <i class="fa-solid fa-box-archive"></i> {{ __('Archive') }}
                                </x-danger-button>
                            @endif
                            <x-primary-button type="button" onclick="location.href='{{ route('blog.adminIndex', ['page' => request('page')]) }}'" class="mt-3" id="back-btn">
                                <i class="fa-solid fa-angles-left"></i> {{ __('Back') }}
                            </x-primary-button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include('blog.publish-modal')
    @include('blog.reject-modal')
    @include('blog.archive-modal')
</x-app-layout>


