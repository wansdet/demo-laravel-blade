<div class="modal fade" id="publishModal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publishModalLabel">Confirm Publish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Are you sure you want to publish this blog post?
            </div>
            <div class="modal-footer">
                <x-primary-button type="button" data-bs-dismiss="modal">Cancel</x-primary-button>
                <form id="submitForm" method="POST" action="{{ route('blog.publish', ['blogPost' => $blogPost->id]) }}">
                    @csrf
                    @method('PUT')
                    <x-success-button type="submit">
                        {{ __('Submit') }}
                    </x-success-button>
                </form>
            </div>
        </div>
    </div>
</div>
