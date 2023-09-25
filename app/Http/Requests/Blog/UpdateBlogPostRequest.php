<?php

namespace App\Http\Requests\Blog;

use App\Models\BlogPost;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', Rule::unique(BlogPost::class)->ignore($this->blogPost->id)],
            'blog_category_id' => 'required',
            'content' => ['required', 'max:4000'],
            'tags' => ['max:255'],
            'image' => ['image', 'max:2048'],
        ];
    }
}
