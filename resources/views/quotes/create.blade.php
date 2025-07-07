@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4 bg-mms-navy p-3 rounded">Create Quote</h1>
@include('partials.alerts')
<form method="POST" action="{{ route('quotes.store') }}">
    @csrf
    <div class="mb-3">
        <label for="customer" class="form-label">Customer</label>
        <select id="customer" name="customer_id" class="form-select" onchange="updateCurrency()">
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" data-currency="{{ $customer->currency }}">{{ $customer->company }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="currency" class="form-label">Currency</label>
        <select id="currency" name="currency" class="form-select">
            @foreach ($currencies as $currency)
                <option value="{{ $currency }}">{{ $currency }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="status" value="Draft">
    <input type="hidden" name="quote_date" value="{{ date('Y-m-d') }}">
    <div id="quote-items">
        <div class="row g-2 mb-2 quote-item-row">
            <div class="col-5">
                <select name="item[]" class="form-select item-select" onchange="updatePrice(this)">
                    <option value="">Select Product or Kit</option>
                    @foreach ($productsByCategory as $category => $products)
                        <optgroup label="{{ $category }}">
                            @foreach ($products as $product)
                                <option value="product-{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                    @if (!empty($kits))
                        <optgroup label="Kits">
                            @foreach ($kits as $kit)
                                <option value="kit-{{ $kit->id }}" data-price="{{ $kit->total_price }}">[Kit] {{ $kit->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                </select>
            </div>
            <div class="col-2">
                <input type="number" class="form-control qty-input" name="qty[]" placeholder="Quantity" min="1" value="1" onchange="updateTotals()">
            </div>
            <div class="col-2">
                <input type="text" class="form-control price-input" name="price[]" placeholder="Unit Price" readonly>
            </div>
            <div class="col-2">
                <input type="text" class="form-control line-total-input" name="line_total[]" placeholder="Line Total" readonly>
            </div>
            <div class="col-1 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeQuoteItem(this)">&times;</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-secondary mb-3" onclick="addQuoteItem()">Add Item</button>
    <div class="mb-3">
        <label class="form-label">Subtotal</label>
        <input type="text" id="subtotal" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">VAT (15%)</label>
        <input type="text" id="vat" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Total</label>
        <input type="text" id="total" class="form-control" readonly>
    </div>
    <button type="submit" class="btn bg-mms-green text-white">Generate Quote</button>
</form>

<script>
function addQuoteItem() {
    const container = document.getElementById('quote-items');
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 quote-item-row';
    row.innerHTML = `
        <div class="col-5">
            <select name="item[]" class="form-select item-select" onchange="updatePrice(this)">
                <option value="">Select Product or Kit</option>
                @foreach ($productsByCategory as $category => $products)
                    <optgroup label="{{ $category }}">
                        @foreach ($products as $product)
                            <option value="product-{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
                @if (!empty($kits))
                    <optgroup label="Kits">
                        @foreach ($kits as $kit)
                            <option value="kit-{{ $kit->id }}" data-price="{{ $kit->total_price }}">[Kit] {{ $kit->name }}</option>
                        @endforeach
                    </optgroup>
                @endif
            </select>
        </div>
        <div class="col-2">
            <input type="number" class="form-control qty-input" name="qty[]" placeholder="Quantity" min="1" value="1" onchange="updateTotals()">
        </div>
        <div class="col-2">
            <input type="text" class="form-control price-input" name="price[]" placeholder="Unit Price" readonly>
        </div>
        <div class="col-2">
            <input type="text" class="form-control line-total-input" name="line_total[]" placeholder="Line Total" readonly>
        </div>
        <div class="col-1 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeQuoteItem(this)">&times;</button>
        </div>
    `;
    container.appendChild(row);
}
function removeQuoteItem(btn) {
    btn.closest('.quote-item-row').remove();
    updateTotals();
}
function updatePrice(select) {
    const price = select.options[select.selectedIndex].getAttribute('data-price') || 0;
    const row = select.closest('.quote-item-row');
    row.querySelector('.price-input').value = price;
    updateLineTotal(row);
    updateTotals();
}
function updateLineTotal(row) {
    const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
    const price = parseFloat(row.querySelector('.price-input').value) || 0;
    row.querySelector('.line-total-input').value = (qty * price).toFixed(2);
}
function updateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.quote-item-row').forEach(row => {
        updateLineTotal(row);
        subtotal += parseFloat(row.querySelector('.line-total-input').value) || 0;
    });
    document.getElementById('subtotal').value = subtotal.toFixed(2);
    const vat = subtotal * 0.15;
    document.getElementById('vat').value = vat.toFixed(2);
    document.getElementById('total').value = (subtotal + vat).toFixed(2);
}
function updateCurrency() {
    const customerSelect = document.getElementById('customer');
    const selected = customerSelect.options[customerSelect.selectedIndex];
    const currency = selected.getAttribute('data-currency');
    if (currency) {
        document.getElementById('currency').value = currency;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    updateTotals();
    updateCurrency();
    document.querySelectorAll('.item-select').forEach(select => {
        updatePrice(select);
    });
});
</script>

@include('quotes.partials.product-picker')
<script src="{{ asset('js/product-modal.js') }}"></script>
@endsection