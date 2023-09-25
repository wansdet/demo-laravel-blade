@props(['status', 'class' => ''])

@switch($status)
    @case('draft')
        <x-primary-button :class="$class">{{ __('Draft') }}</x-primary-button>
        @break

    @case('submitted')
        <x-warning-button :class="$class">{{ __('Submitted') }}</x-warning-button>
        @break

    @case('rejected')
        <x-danger-button :class="$class">{{ __('Rejected') }}</x-danger-button>
        @break

    @case('published')
        <x-success-button :class="$class">{{ __('Published') }}</x-success-button>
        @break

    @case('archived')
        <x-danger-button :class="$class">{{ __('Archived') }}</x-danger-button>
        @break

    @default
@endswitch

