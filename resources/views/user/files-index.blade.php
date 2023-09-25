<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __('User Files') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="h-half-screen bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($userFiles) > 0)
                    <div class="p-6 text-gray-900">
                        <table class="table-auto w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">{{ __('Filename') }}</th>
                                <th class="px-4 py-2">{{ __('Date') }}</th>
                                <th class="px-4 py-2">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($userFiles as $index => $file)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="border px-4 py-2">{{ $file['filename'] }}</td>
                                    <td class="border px-4 py-2">{{ $file['lastModified'] }}</td>
                                    <td class="border px-4 py-2 flex items-center justify-center">
                                        <x-primary-button type="button" class="download-button" data-file-url="{{ $file['url'] }}">
                                            <i class="fa-solid fa-download"></i> {{ __('Download') }}
                                        </x-primary-button>
                                        <!-- Hidden <a> tag for download -->
                                        <a style="display: none;" class="hidden-download" href="{{ $file['url'] }}"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex-grow p-6 text-gray-900">
                        <p>No files found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.download-button', function() {
                // Find the hidden <a> tag for download in the same row
                const hiddenDownload = $(this).siblings('.hidden-download');

                // Simulate a click on the hidden <a> tag to trigger the download
                hiddenDownload[0].click();
            });
        });
    </script>
</x-app-layout>
