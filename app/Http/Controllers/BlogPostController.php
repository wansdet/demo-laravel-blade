<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\ExportBlogPostRequest;
use App\Http\Requests\Blog\StoreBlogPostRequest;
use App\Http\Requests\Blog\UpdateBlogPostRequest;
use App\Jobs\ExportBlogPostReport;
use App\Mail\BlogPostSubmitted;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostImage;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog.index', [
            'blogPosts' => BlogPost::latest()
                ->filter(request(['tag', 'search', 'author', 'category']))
                ->where('status', BlogPost::STATUS_PUBLISHED)
                ->paginate(5)
        ]);
    }

    /**
     * Display a listing of the resource for the blogger.
     * @throws AuthorizationException
     */

    public function bloggerIndex()
    {
        Gate::authorize('author-blog', auth()->user());

        $blogPosts = BlogPost::latest()->filter(request(['search']))->where('user_id', auth()->id())->paginate(5);

        return view('blog.blogger-index', ['blogPosts' => $blogPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('author-blog', auth()->user());

        $categories = BlogCategory::all();

        return view('blog.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(StoreBlogPostRequest $request)
    {
        $formFields = $request->validated();

        $formFields['status'] = BlogPost::STATUS_DRAFT;
        $formFields['user_id'] = auth()->id();

        $newBlogPost = BlogPost::create($formFields);

        return redirect(route('blog.edit', $newBlogPost))->with('message', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $blogPost = BlogPost::where('slug', $slug)->firstOrFail();
        $images = BlogPostImage::where('blog_post_id', $blogPost->id)->get();

        return view('blog.show-public', [
            'blogPost' => $blogPost,
            'index' => 'blog.index',
            'images' => $images
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showBlogger(string $slug)
    {
        Gate::authorize('author-blog', auth()->user());

        $blogPost = BlogPost::where('slug', $slug)->firstOrFail();
        $images = BlogPostImage::where('blog_post_id', $blogPost->id)->get();

        return view('blog.show-blogger', [
            'blogPost' => $blogPost,
            'index' => 'blog.bloggerIndex',
            'images' => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        Gate::authorize('update-blog', $blogPost);

        $images = BlogPostImage::where('blog_post_id', $blogPost->id)->get();

        return view('blog.edit', [
            'blogPost' => $blogPost,
            'categories' => BlogCategory::all(),
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost)
    {
        Gate::authorize('update-blog', $blogPost);

        $formFields = $request->validated();

        if ($request->hasFile('image')) {
            $storagePath = BlogPostImage::STORAGE_PATH . '/'. $blogPost->id;
            $storagePathURL = BlogPostImage::STORAGE_PATH_URL . '/'. $blogPost->id;
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs($storagePath, $filename);

            // Store details in Blog Post Image table
            BlogPostImage::create([
                'path' => $storagePathURL,
                'filename' => $filename,
                'blog_post_id' => $blogPost->id,
            ]);
        }

        $blogPost->update($formFields);

        return redirect(route('blog.edit', $blogPost))->with('message', 'Blog post updated successfully.');
    }

    public function submit(BlogPost $blogPost)
    {
        Gate::authorize('submit-blog', $blogPost);

        $blogPost->update(['status' => BlogPost::STATUS_SUBMITTED]);

        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new BlogPostSubmitted($blogPost, auth()->user()));

        return redirect(route('blog.bloggerIndex'))->with('message', 'Blog post submitted.');
    }

    public function exportBloggerReport(ExportBlogPostRequest $request)
    {
        Gate::authorize('author-blog', auth()->user());

        $formFields = $request->validated();

        $filters = ['user_id' => auth()->user()->id];
        $format = $formFields['format'];

        dispatch(new ExportBlogPostReport(auth()->user(), $filters, $format));

        //return redirect(route('blog.bloggerIndex'))->with('message', 'Blog post report exported.');
        return response('Blog post report exported.', 200);
    }
}
