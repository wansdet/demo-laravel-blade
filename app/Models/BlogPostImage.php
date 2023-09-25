<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostImage extends Model
{
    use HasFactory;

    public const STORAGE_PATH = 'public/assets/images/blog/posts';
    public const STORAGE_PATH_URL = '/storage/assets/images/blog/posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'path',
        'filename',
        'caption',
        'blog_post_id'
    ];

    // Many-to-one relationship to Blog Post
    public function blogPost() {
        return $this->belongsTo(BlogCategory::class, 'blog_post_id');
    }
}
