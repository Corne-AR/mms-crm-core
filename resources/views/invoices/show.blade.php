@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4">Invoice Details</h1>
@include('partials.alerts')
<div class="card">
    <div class="card-body">
        <h5>Invoice #12345</h5>
        <p><strong>Customer:</strong> Example Co.</p>
        <p><strong>Total:</strong> R 12,345.00</p>
        <a href="{{ asset('storage/invoices/sample.pdf') }}" target="_blank" class="btn btn-outline-primary">View PDF</a>
    </div>
</div>
@endsection