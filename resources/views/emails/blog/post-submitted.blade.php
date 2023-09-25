<x-mail::message>
# New Blog Post Submission

A new blog post has been submitted for review.

**Title:** {{ $title }}

**Author:** {{ $author }}

**Email:** [{{ $email }}](mailto:{{ $email }})

Thank you for your submission.

<x-mail::button :url="url('/blog/admin')">
    View Blog Post
</x-mail::button>

Thanks,

{{ config('app.name') }}
</x-mail::message>

