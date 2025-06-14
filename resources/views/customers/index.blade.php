@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4">Customers</h1>
@include('partials.alerts')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Phone</th>
                <th>VAT Number</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($customers as $customer) --}}
            <tr>
                <td>Example Co.</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>+123456789</td>
                <td>1234567890</td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>
@endsection