<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    public const STATUS_ARCHIVED = 'archived';

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_REJECTED = 'rejected';

    public const STATUS_SUBMITTED = 'submitted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'blog_category_id',
        'tags',
        'status',
        'user_id',
    ];

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['author'] ?? false, function ($query, $author) {
                return $query->whereHas('user', function ($query) use ($author) {
                    $query->where('name', 'like', '%' . $author . '%');
                });
            })
            ->when($filters['category'] ?? false, function ($query, $category) {
                return $query->whereHas('category', function ($query) use ($category) {
                    $query->where('name', 'like', '%' . $category . '%');
                });
            })
            ->when($filters['tag'] ?? false, function ($query, $tag) {
                return $query->where('tags', 'like', '%' . $tag . '%');
            })
            ->when($filters['search'] ?? false, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%')
                        ->orWhere('tags', 'like', '%' . $search . '%');
                });
            });
    }

    // One-to-many relationship with Blog Post Images
    public function images() {
        return $this->hasMany(BlogPostImage::class, 'blog_post_id');
    }

    // Many-to-one relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Many-to-one relationship to Blog Category
    public function category() {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
