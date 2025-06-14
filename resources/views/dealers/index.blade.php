@extends('layouts.app-with-sidebar')

@section('content')
<h1 class="mb-4">Dealers</h1>
@include('partials.alerts')
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dealer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($dealers as $dealer) --}}
            <tr>
                <td>Awesome Dealer</td>
                <td>Jane Doe</td>
                <td>jane@dealer.com</td>
                <td>+987654321</td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>
@endsection