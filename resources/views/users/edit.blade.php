@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="mb-3">
            <label>Dealer</label>
            <select name="dealer_id" class="form-select">
                <option value="">-- Select Dealer --</option>
                @foreach($dealers as $dealer)
                    <option value="{{ $dealer->id }}" {{ $user->dealer_id == $dealer->id ? 'selected' : '' }}>
                        {{ $dealer->dealer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="user_role_id" class="form-select">
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->user_role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
