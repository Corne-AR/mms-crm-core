<!DOCTYPE html>
<html>
<head>
    <title>Welcome to MMS Design CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center py-5">
        <h1 class="mb-4">Welcome to MMS Design Dealer & Sub-Dealer CRM</h1>
        <p class="lead">Manage your customers, quotes, invoices, and kits — all in one place.</p>

        @if (Route::has('login'))
            <div class="mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary ms-2">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>