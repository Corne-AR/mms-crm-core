<!-- resources/views/dealers/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Dealers</h1>
    <a href="{{ route('dealers.create') }}" class="btn btn-primary mb-3">Add New Dealer</a>
    <table class="table table-bordered">
		<thead>
			<tr>
				<th>Logo</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($dealers as $dealer)
				<tr>
					<td>
						@if ($dealer->logo)
							<img src="{{ asset('storage/' . $dealer->logo) }}" alt="Logo" style="height:40px;">
						@else
							<span class="text-muted">No Logo</span>
						@endif
					</td>
					<td>{{ $dealer->dealer_name }}</td>
					<td>{{ $dealer->contact_person }}</td>
					<td>{{ $dealer->email }}</td>
					<td>
						<a href="{{ route('dealers.show', $dealer) }}" class="btn btn-info btn-sm">View</a>
						<a href="{{ route('dealers.edit', $dealer) }}" class="btn btn-warning btn-sm">Edit</a>
						<form action="{{ route('dealers.destroy', $dealer) }}" method="POST" style="display:inline-block">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-sm">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
    </table>
</div>
@endsection
