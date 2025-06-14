<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="MMS Design CRM - Manage dealers, customers, products, and more.">
	<meta name="theme-color" content="#008e49">


    <title>{{ config('app.name', 'MMS Design CRM') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/WebIcon.png') }}">

    {{-- External Fonts (Optional) --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    {{-- Custom CSS for MMS Design Brand --}}
    <link href="{{ asset('css/mms-brand.css') }}" rel="stylesheet">

    {{-- Bootstrap / Optional Vendor --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- App-wide Scripts/Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Filament Styles if used --}}
    @filamentStyles

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-light text-dark">
    @include('partials.navbar')

    <main class="container-fluid py-4">
        @yield('content')
		
		@if (session('status'))
			<div class="alert alert-success">{{ session('status') }}</div>
		@endif

    </main>

    @include('partials.footer')

    {{-- Filament Scripts if used --}}
    @filamentScripts
</body>
</html>
