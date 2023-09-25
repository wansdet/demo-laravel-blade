@props(['disabled' => false])

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border border-gray-200 rounded p-2 w-full']) !!}
>
    {{ $slot }}
</textarea>
