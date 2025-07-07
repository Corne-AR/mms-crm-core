<!DOCTYPE html>
<html>
<head>
    <title>CRM Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/mms-brand.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4 bg-mms-navy p-3 rounded text-center">Welcome, {{ Auth::user()->name }}!</h1>

        <div class="row g-3">

            <div class="col-md-4">
                <a href="{{ route('customers.index') }}" class="btn bg-mms-green text-white w-100">
                    Manage Customers
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('quotes.index') }}" class="btn bg-mms-green text-white w-100">
                    Manage Quotes
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('invoices.index') }}" class="btn btn-warning w-100">
                    Manage Invoices
                </a>
            </div>

            <div class="col-md-4 mt-3">
                <a href="{{ route('kits.index') }}" class="btn btn-info w-100">
                    Manage Kits
                </a>
            </div>

            <div class="col-md-4 mt-3">
                <a href="{{ url('/') }}" class="btn btn-secondary w-100">
                    Back to Welcome
                </a>
            </div>

            <div class="col-md-4 mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</body>
</html>