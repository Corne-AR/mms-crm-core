@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Dealers</h1>
        <a href="{{ route('dealers.create') }}" class="btn btn-primary">Add Dealer</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dealer Name</th>
                <th>Type</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dealers as $dealer)
            <tr>
                <td>{{ $dealer->id }}</td>
                <td>{{ $dealer->dealer_name }}</td>
                <td>{{ $dealer->type }}</td>
                <td>{{ $dealer->contact_person }}</td>
                <td>{{ $dealer->email }}</td>
                <td>{{ $dealer->phone }}</td>
                <td>
                    <a href="{{ route('dealers.show', $dealer->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('dealers.edit', $dealer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dealers.destroy', $dealer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
