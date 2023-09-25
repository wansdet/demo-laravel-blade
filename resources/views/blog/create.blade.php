<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{route('blog.store')}}">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input type="text" class="block mt-1 w-full" id="title" name="title" value="{{old('title')}}" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Slug -->
                    <div class="mb-6">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input type="text" class="block mt-1 w-full" id="slug" name="slug" value="{{old('slug')}}" autofocus />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="blog_category_id" name="blog_category_id" class="block mt-1 w-full">
                            <option value="">{{__('Select category')}}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{old('blog_category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('blog_category_id')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-textarea id="content" name="content" rows="10">{{old('content')}}</x-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Tags -->
                    <div class="mb-6">
                        <x-input-label for="tags" :value="__('Tags')" />
                        <x-text-input type="text" class="block mt-1 w-full" id="tags" name="tags" value="{{old('tags')}}" />
                        <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-primary-button class="mt-3" id="submit">
                            {{ __('Create Post') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('blog.tinymce-content')
</x-app-layout>
