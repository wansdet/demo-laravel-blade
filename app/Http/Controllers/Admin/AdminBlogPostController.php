<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\ExportBlogPostRequest;
use App\Jobs\ExportBlogPostReport;
use App\Mail\BlogPostStatusUpdated;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class AdminBlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminIndex()
    {
        Gate::authorize('admin-blog', auth()->user());

        return view('blog.admin-index', [
            'blogPosts' => BlogPost::latest()->filter(request(['tag', 'search', 'author', 'category']))->paginate(15)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showAdmin(string $slug)
    {
        Gate::authorize('admin-blog', auth()->user());

        $blogPost = BlogPost::where('slug', $slug)->firstOrFail();
        $images = BlogPostImage::where('blog_post_id', $blogPost->id)->get();

        return view('blog.show-admin', [
            'blogPost' => $blogPost,
            'index' => 'blog.adminIndex',
            'images' => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function manage(BlogPost $blogPost)
    {
        Gate::authorize('admin-blog', auth()->user());

        $images = BlogPostImage::where('blog_post_id', $blogPost->id)->get();

        return view('blog.manage', [
            'blogPost' => $blogPost,
            'categories' => BlogCategory::all(),
            'images' => $images
        ]);
    }

    public function reject(BlogPost $blogPost)
    {
        Gate::authorize('reject-blog', $blogPost);

        $blogPost->update(['status' => BlogPost::STATUS_REJECTED]);

        Mail::to($blogPost->user->email)->queue(new BlogPostStatusUpdated($blogPost, 'Rejected'));

        return redirect(route('blog.manage', ['blogPost' => $blogPost, 'page' => request('page')]))->with('message', 'Blog post rejected.');
    }


    public function publish(BlogPost $blogPost)
    {
        Gate::authorize('publish-blog', $blogPost);

        $blogPost->update(['status' => BlogPost::STATUS_PUBLISHED]);

        Mail::to($blogPost->user->email)->queue(new BlogPostStatusUpdated($blogPost, 'Published'));

        return redirect(route('blog.manage', ['blogPost' => $blogPost, 'page' => request('page')]))->with('message', 'Blog post published.');
    }


    public function archive(BlogPost $blogPost)
    {
        Gate::authorize('archive-blog', $blogPost);

        $blogPost->update(['status' => BlogPost::STATUS_ARCHIVED]);

        Mail::to($blogPost->user->email)->queue(new BlogPostStatusUpdated($blogPost, 'Archived'));

        return redirect(route('blog.manage', ['blogPost' => $blogPost, 'page' => request('page')]))->with('message', 'Blog post archived.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        Gate::authorize('delete-blog', $blogPost);

        $blogPost->delete();

        return redirect(route('blog.bloggerIndex'))->with('message', 'Blog post deleted.');
    }

    public function exportAdminReport(ExportBlogPostRequest $request)
    {
        Gate::authorize('admin-blog', auth()->user());

        $formFields = $request->validated();

        $filters = [];
        $format = $formFields['format'];

        dispatch(new ExportBlogPostReport(auth()->user(), $filters, $format));

        // return redirect(route('blog.adminIndex'))->with('message', 'Blog post report exported.');
        return response('Blog post report exported.', 200);
    }
}
