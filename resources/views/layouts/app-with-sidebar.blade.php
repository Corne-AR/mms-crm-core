<!-- resources/views/layouts/app-with-sidebar.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MMS Design CRM</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mms-brand.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    <div class="d-flex flex-column vh-100 bg-dark text-white" style="width: 250px;">
        <div class="p-3 flex-grow-1 overflow-auto">
            <h4 class="text-white text-center">MMS Design CRM</h4>
            <ul class="nav flex-column mt-4">
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link text-white">Customers</a></li>
                <li class="nav-item"><a href="{{ route('dealers.index') }}" class="nav-link text-white">Dealers</a></li>
                <li class="nav-item"><a href="{{ route('quotes.index') }}" class="nav-link text-white">Quotes</a></li>
                
                @can('view-admin')
                <hr class="text-secondary">
                <li class="nav-item"><strong class="text-uppercase small text-muted px-3">Admin</strong></li>
                <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link text-white">Users</a></li>
                @endcan
            </ul>
        </div>

        <!-- Footer pinned -->
        <div class="p-3 border-top border-secondary text-center">
            @auth
                <div class="small text-white-50 mb-2">
                    Signed in as:<br>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-outline-light btn-sm w-100 mb-1">Sign Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm w-100">Sign In</a>
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

</body>
</html>
