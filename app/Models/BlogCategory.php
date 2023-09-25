<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active',
        'sort_order',
    ];

    // One-to-many relationship with BlogPosts
    public function blogPosts() {
        return $this->hasMany(BlogPost::class, 'blog_category_id');
    }
}
