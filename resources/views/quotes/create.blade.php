@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4">Create Quote</h1>
@include('partials.alerts')
<form method="POST" action="{{ route('quotes.store') }}">
    @csrf
    <div class="mb-3">
        <label for="customer" class="form-label">Customer</label>
        <select id="customer" name="customer_id" class="form-select">
            {{-- @foreach ($customers as $customer) --}}
            <option value="1">Example Co.</option>
            {{-- @endforeach --}}
        </select>
    </div>
    <div id="quote-items">
        <div class="row g-2 mb-2">
            <div class="col">
                <input type="text" class="form-control" name="product[]" placeholder="Product Name">
            </div>
            <div class="col">
                <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
            </div>
        </div>
    </div>
	<!-- Button to launch product modal -->
	<button type="button" class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#productPickerModal">
		<i class="bi bi-box-seam"></i> Add Product from Catalog
	</button>
    <button type="button" class="btn btn-secondary mb-3" onclick="addQuoteItem()">Add Item</button>
    <button type="submit" class="btn btn-primary">Generate Quote</button>
</form>

<script>
function addQuoteItem() {
    const container = document.getElementById('quote-items');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2';
    row.innerHTML = `
        <div class="col">
            <input type="text" class="form-control" name="product[]" placeholder="Product Name">
        </div>
        <div class="col">
            <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
        </div>`;
    container.appendChild(row);
}
</script>

@include('quotes.partials.product-picker')

<script src="{{ asset('js/product-modal.js') }}"></script>

@endsection