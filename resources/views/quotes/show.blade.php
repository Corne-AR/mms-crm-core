@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4">Quote #{{ $quote->quote_number }}</h1>
@include('partials.alerts')

<div class="mb-3">
    <strong>Date:</strong> {{ optional($quote->quote_date)->format('Y-m-d') ?? '-' }}<br>
    <strong>Status:</strong> {{ $quote->status }}<br>
    <strong>Customer:</strong> {{ $quote->customer->company ?? '-' }}<br>
    <strong>Dealer:</strong> {{ $quote->dealer->name ?? '-' }}<br>
    <strong>Currency:</strong> {{ $quote->currency }}
</div>

<a href="{{ route('quotes.print', $quote) }}" class="btn btn-outline-primary mb-3">Print</a>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Line Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($quote->items as $item)
            <tr>
                <td>
                    @if ($item->kit)
                        <strong>[Kit]</strong> {{ $item->display_name }}
                    @else
                        {{ $item->display_name }}
                    @endif
                </td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->line_total, 2) }}</td>
            </tr>
            @if ($item->kit)
                <tr>
                    <td colspan="4">
                        <ul class="mb-0 ps-4">
                            @foreach ($item->kit->items as $kitItem)
                                <li>{{ $kitItem->product->name }} (x{{ $kitItem->qty }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end">Subtotal</th>
            <th>{{ number_format($quote->subtotal, 2) }}</th>
        </tr>
        <tr>
            <th colspan="3" class="text-end">VAT (15%)</th>
            <th>{{ number_format($quote->vat_amount, 2) }}</th>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Total</th>
            <th>{{ number_format($quote->total_amount, 2) }}</th>
        </tr>
    </tfoot>
</table>

<a href="{{ route('quotes.index') }}" class="btn btn-secondary">Back to Quotes</a>
@endsection
