<?php

namespace App\Exports;

use App\Models\BlogPost;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlogPostsExport implements FromCollection, WithHeadings
{
    protected array $filters = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $query = BlogPost::query()->orderByDesc('id');

        if (isset($this->filters['user_id'])) {
            $query->where('user_id', $this->filters['user_id']);
        }

        if (isset($this->filters['title'])) {
            $query->whereHas('tags', function ($query) {
                $query->where('title', 'LIKE', '%' . $this->filters['title'] . '%');
            });
        }

        if (isset($this->filters['tag'])) {
            $query->whereHas('tags', function ($query) {
                $query->where('tag', 'LIKE', '%' . $this->filters['tag'] . '%');
            });
        }

        if (isset($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }

        if (isset($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        $blogPosts = $query->get();

        return $blogPosts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'category' => $post->category->name,
                'author' => $post->user->name,
                'createdAt' => $post->created_at,
                'updatedAt' => $post->updated_at,
                'status' => $post->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Category',
            'Author',
            'Created At',
            'Updated At',
            'Status',
        ];
    }
}
