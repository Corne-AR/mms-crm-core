{{-- resources/views/quotes/partials/product-picker.blade.php --}}
<div class="modal fade" id="productPickerModal" tabindex="-1" aria-labelledby="productPickerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="productPickerModalLabel">Select Product</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="productSearchInput" placeholder="Search by name, type, or category...">

                <div class="row" id="productList">
                    {{-- Dynamically populated via JS --}}
                </div>
            </div>
        </div>
    </div>
</div>
