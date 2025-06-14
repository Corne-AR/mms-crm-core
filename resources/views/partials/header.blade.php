{{-- resources/views/partials/header.blade.php --}}
<header class="bg-light p-3 mb-3 border-bottom shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h1 class="h4 m-0">@yield('page-title', 'Welcome')</h1>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-secondary btn-sm" @click="darkMode = !darkMode">
                <i class="bi bi-moon-stars"></i>
            </button>
            <span class="badge bg-success">{{ Auth::user()->name ?? 'Guest' }}</span>
        </div>
    </div>
</header>
