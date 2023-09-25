<div class="modal fade" id="bloggerExportModal" tabindex="-1" aria-labelledby="bloggerExportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bloggerExportModalLabel">Blog Post Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="mb-3">Please select the export format.</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exportFormat" id="exportExcel" value="EXCEL" checked>
                    <label class="form-check-label" for="exportExcel">
                        Export as Excel
                    </label>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" name="exportFormat" id="exportCSV" value="CSV">
                    <label class="form-check-label" for="exportCSV">
                        Export as CSV
                    </label>
                </div>
            </div>
            <input type="hidden" id="selectedFormat" name="format" value="">
            <div class="modal-footer">
                <x-primary-button type="button" data-bs-dismiss="modal">Cancel</x-primary-button>
                <x-primary-button id="submitExportButton">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {
        const radioButtons = $("#bloggerExportModal input[name='exportFormat']");
        const selectedFormatInput = $("#selectedFormat");
        selectedFormatInput.val('EXCEL');

        radioButtons.on("change", function() {
            const selectedFormat = $("input[name='exportFormat']:checked").val();
            selectedFormatInput.val(selectedFormat);
        });

        $("#submitExportButton").on("click", (event) => {
            event.preventDefault();
            const selectedFormat = selectedFormatInput.val();

            axios.post('{{ route('blog.exportBloggerReport') }}', {
                format: selectedFormat
            })
                .then(response => {
                    // console.log('Export completed:', response.data);
                    showFlashMessage(response.data, 'success');
                    $('#bloggerExportModal').modal('hide');
                })
                .catch(error => {
                    // console.error('Export error:', error.response);
                    showFlashMessage('Document not exported. Please try again or contact admin.', 'error');
                    $('#bloggerExportModal').modal('hide');
                });
        });
    });
</script>
