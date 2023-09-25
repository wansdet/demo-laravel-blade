<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-half-screen overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-10 text-gray-900 prose max-w-none">
                    <p>
                        This application is a demonstration of Laravel using MVC architecture with Blade/Breeze/Tailwind.css.
                    </p>
                    <p>
                        Please see the README.md file for installation instructions.
                    </p>
                    <p>
                        The first phase implements a multi-tenant blog application with the following features:
                    </p>
                    <ol>
                        <li>Blog authors are users with role ROLE_BLOGGER</li>
                        <li>Blog editors are users with role ROLE_EDITOR</li>
                        <li>Blog post Workflow - draft, submitted, rejected, published, archived</li>
                        <li>Administration screens for blog creation, updates and workflow management. Bloggers can submit blog posts. Blog editor manage the workflow.</li>
                    </ol>
                    <p>
                        This phase demonstrates the following Laravel basic and advanced features:
                    </p>
                    <ol>
                        <li>Routing/Controllers</li>
                        <li>Requests/Responses/Validation/Error handling/CSRF Protection</li>
                        <li>URL Generation</li>
                        <li>Models/Relationships/Migrations/Seeding</li>
                        <li>Views/Blade Templates</li>
                        <li>Broadcasting</li>
                        <li>Events</li>
                        <li>File storage</li>
                        <li>Mail</li>
                        <li>Notifications</li>
                        <li>Queues</li>
                        <li>Authentication</li>
                        <li>Authorization/Gates/Policies</li>
                        <li>Eloquent ORM/Query Builder/Pagination</li>
                    </ol>
                    <p>
                        The second phase will implement blog comment functionality and complete the management of blog post images.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
