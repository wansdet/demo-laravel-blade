<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any BlogPosts.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the BlogPost.
     */
    public function view(User $user, BlogPost $blogPost): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(User::ROLE_BLOGGER);
    }

    /**
     * Determine whether the user can author the BlogPost.
     */
    public function author(User $user): bool
    {
        // has role blogger
        return $user->hasRole(User::ROLE_BLOGGER);
    }


    /**
     * Determine whether the user can admin the BlogPost.
     */
    public function admin(User $user): bool
    {
        // has role editor
        return $user->hasRole(User::ROLE_EDITOR);
    }

    /**
     * Determine whether the user can update the BlogPost.
     */
    public function update(User $user, BlogPost $blogPost): bool
    {
        // has role editor or is author of the blog post
        return $user->hasRole(User::ROLE_EDITOR) || $user->id === $blogPost->user_id;
    }

     /**
     * Determine whether the user can submit the BlogPost.
     */
    public function submit(User $user, BlogPost $blogPost): bool
    {
        return $user->id === $blogPost->user_id && 
            in_array($blogPost->status, [BlogPost::STATUS_DRAFT, BlogPost::STATUS_REJECTED], true);
    }

    /**
     * Determine whether the user can publish the BlogPost.
     */
    public function publish(User $user, BlogPost $blogPost): bool
    {
        return $user->hasRole(User::ROLE_EDITOR) && $blogPost->status = BlogPost::STATUS_SUBMITTED;
    }

    /**
     * Determine whether the user can reject the BlogPost.
     */
    public function reject(User $user, BlogPost $blogPost): bool
    {
        return $user->hasRole(User::ROLE_EDITOR) && $blogPost->status = BlogPost::STATUS_SUBMITTED;
    }

    /**
     * Determine whether the user can archive the BlogPost.
     */
    public function archive(User $user, BlogPost $blogPost): bool
    {
        return $user->hasRole(User::ROLE_EDITOR) && $blogPost->status = BlogPost::STATUS_PUBLISHED;
    }

    /**
     * Determine whether the user can delete the BlogPost.
     */
    public function delete(User $user, BlogPost $blogPost): bool
    {
        // has role editor or is author of the blog post
        return $user->hasRole(User::ROLE_EDITOR) || $user->id === $blogPost->user_id;
    }

    /**
     * Determine whether the user can restore the BlogPost.
     */
    public function restore(User $user, BlogPost $blogPost): bool
    {
        return $user->hasRole(User::ROLE_EDITOR);
    }

    /**
     * Determine whether the user can permanently delete the BlogPost.
     */
    public function forceDelete(User $user, BlogPost $blogPost): bool
    {
        return $user->hasRole(User::ROLE_EDITOR);
    }
}
