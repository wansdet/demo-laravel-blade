<x-mail::message>
# Blog Post Status Updated

**Title:** {{ $title }}

**Author:** {{ $author }}

**Email:** [{{ $email }}](mailto:{{ $email }})

**Status:** {{ $status }}

<x-mail::button :url="url('/blog/my-posts')">
    View Blog Post
</x-mail::button>

Thanks,

{{ config('app.name') }}
</x-mail::message>
