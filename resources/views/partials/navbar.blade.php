{{-- resources/views/partials/navbar.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/WebIcon.png') }}" alt="Logo" width="30" class="me-2">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                @can('viewInternalDashboard')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.internal') }}"><i class="bi bi-bar-chart"></i> Internal Dashboard</a>
                </li>
                @endcan
                @can('viewDealerDashboard')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.dealer') }}"><i class="bi bi-graph-up"></i> Dealer Dashboard</a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customers.index') }}"><i class="bi bi-people"></i> Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quotes.index') }}"><i class="bi bi-file-earmark-text"></i> Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('invoices.index') }}"><i class="bi bi-receipt"></i> Invoices</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name ?? 'Account' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>