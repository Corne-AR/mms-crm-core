<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true, darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MMS Design CRM') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/mms-brand.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .sidebar {
            width: 250px;
            transition: transform 0.3s ease;
        }
        .sidebar-closed {
            transform: translateX(-100%);
        }
        .content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        .content-expanded {
            margin-left: 0;
        }
        .dark body {
            background-color: #1e1e1e;
            color: #f0f0f0;
        }
        .dark .sidebar {
            background-color: #2b2b2b;
        }
        .dark .content {
            background-color: #1e1e1e;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div :class="{'sidebar': true, 'position-fixed h-100 bg-dark text-white p-3': true, 'sidebar-closed': !sidebarOpen}">
            <h5>{{ config('app.name') }}</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="nav-item d-flex justify-content-between align-items-center">
                    <a class="nav-link text-white" href="{{ route('customers.index') }}"><i class="bi bi-people"></i> Customers</a>
                    <span class="badge bg-danger">3</span>
                </li>
                <li class="nav-item d-flex justify-content-between align-items-center">
                    <a class="nav-link text-white" href="{{ route('quotes.index') }}"><i class="bi bi-file-earmark-text"></i> Quotes</a>
                    <span class="badge bg-primary">5</span>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('invoices.index') }}"><i class="bi bi-receipt"></i> Invoices</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div :class="{'content': true, 'content-expanded': !sidebarOpen}" class="flex-grow-1">
            <nav class="navbar navbar-light bg-light border-bottom px-3">
                <button class="btn btn-outline-success btn-sm me-2" @click="sidebarOpen = !sidebarOpen">
                    <i class="bi bi-list"></i>
                </button>
                <button class="btn btn-outline-dark btn-sm" @click="darkMode = !darkMode">
                    <i class="bi bi-moon-stars"></i>
                </button>
                <span class="ms-auto">Logged in as {{ Auth::user()->name ?? 'Guest' }}</span>
            </nav>
            <main class="p-4">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
