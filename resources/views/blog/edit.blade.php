<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Update Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('blog.update', ['blogPost' => $blogPost->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('blog.image-carousel')

                        <!-- Title -->
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="title" name="title"
                                          value="{{$blogPost->title}}" autofocus/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                        </div>

                        <!-- Slug -->
                        <div class="mb-6">
                            <x-input-label for="slug" :value="__('Slug')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="slug" name="slug"
                                          value="{{$blogPost->slug}}" autofocus/>
                            <x-input-error :messages="$errors->get('slug')" class="mt-2"/>
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <x-input-label for="category" :value="__('Category')"/>
                            <select id="blog_category_id" name="blog_category_id" class="block mt-1 w-full">
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{ $category->id == $blogPost->blog_category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('blog_category_id')" class="mt-2"/>
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <x-input-label for="content" :value="__('Content')"/>
                            <x-textarea id="content" name="content" rows="10">{{$blogPost->content}}</x-textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                        </div>

                        <!-- Tags -->
                        <div class="mb-6">
                            <x-input-label for="tags" :value="__('Tags')"/>
                            <x-text-input type="text" class="block mt-1 w-full" id="tags" name="tags"
                                          value="{{$blogPost->tags}}"/>
                            <x-input-error :messages="$errors->get('tags')" class="mt-2"/>
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status')"/>
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
                            <x-input-error :messages="$errors->get('status')" class="mt-2"/>
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <x-input-label for="image" :value="__('Upload image')"/>
                            <input type="file" class="block mt-1 w-full" id="image" name="image"/>
                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                        </div>

                        <div class="mb-6">
                            <x-primary-button class="mt-3" id="submit-btn">
                                {{ __('Update Post') }}
                            </x-primary-button>
                            <x-primary-button onclick="history.back()" class="mt-3" id="back-btn">
                                <i class="fa-solid fa-angles-left"></i> {{ __('Back') }}
                            </x-primary-button>
                            <x-success-button type="button" id="openSubmitModal" class="mt-7 mb-5"
                                              data-bs-toggle="modal" data-bs-target="#submitModal">
                                <i class="fa-solid fa-upload"></i> {{ __('Submit') }}
                            </x-success-button>
                            <x-danger-button type="button" id="openDeleteModal" class="mt-7 mb-5"
                                              data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                            </x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('blog.submit-modal')
    @include('blog.delete-modal')
    @include('blog.tinymce-content')
</x-app-layout>

