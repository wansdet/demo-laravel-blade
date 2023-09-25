<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('Manage Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-half-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6">
                    <x-primary-button type="button" id="exportModalButton" class="mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#adminExportModal">
                        <i class="fa-solid fa-download"></i> {{ __('Export') }}
                    </x-primary-button>
                </div>
                @include('partials._search_blog_posts')
                <div class="p-6 text-gray-900">
                    @unless(count($blogPosts) == 0)
                    {{ $blogPosts->links() }}
                        <table class="table-auto w-full border-collapse border my-6">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 w-1/6">ID</th>
                                <th class="px-4 py-2 w-2/6">Title</th>
                                <th class="px-4 py-2 w-1/6">Author</th>
                                <th class="px-4 py-2 w-1/6">Status</th>
                                <th class="px-4 py-2 w-1/6">Created</th>
                                <th class="px-4 py-2 w-1/6">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogPosts as $index => $blogPost)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="border px-4 py-2">{{ $blogPost->id }}</td>
                                    <td class="border px-4 py-2"><a href="{{ route('blog.showAdmin', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}">{{ $blogPost->title }}</a></td>
                                    <td class="border px-4 py-2">{{ $blogPost->user->name }}</td>
                                    <td class="border px-4 py-2"><div class="flex>"><x-blog-status :status="$blogPost->status" class="flex-grow" /></div></td>
                                    <td class="border px-4 py-2">{{ $blogPost->created_at }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex">
                                            <x-primary-button onclick="location.href='{{ route('blog.showAdmin', ['blogPost' => $blogPost->slug, 'page' => $blogPosts->currentPage()]) }}'" class="view-btn flex-grow mr-1">
                                                <i class="fa-regular fa-eye"></i> {{ __('View') }}
                                            </x-primary-button>
                                            <x-primary-button onclick="location.href='{{ route('blog.manage', ['blogPost' => $blogPost->id, 'page' => $blogPosts->currentPage()]) }}'" class="manage-btn flex-grow">
                                                <i class="fa-solid fa-pen"></i> {{ __('Manage') }}
                                            </x-primary-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $blogPosts->links() }}
                    @else
                    <p>No blog posts found</p>
                    @endunless
                </div>
            </div>
        </div>
    </div>
    @include('blog.admin-export-modal')
    <!--
    <script type="module">
        $(document).ready(function() {
            Echo.private('export.' + {{ auth()->id() }})
                .listen('ExportCompleted', (event) => {
                    console.log('Export completed:', event);
                });

        });
    </script>
    -->
</x-app-layout>
