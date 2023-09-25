<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this blog post?
            </div>
            <div class="modal-footer">
                <x-primary-button type="button" data-bs-dismiss="modal">Cancel</x-primary-button>
                <form id="deleteForm" method="POST" action="{{ route('blog.destroy', ['blogPost' => $blogPost->id]) }}">
                    @csrf
                    @method('DELETE')
                    <x-danger-button id="deleteModal" type="submit">
                        <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </div>
</div>
