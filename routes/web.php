<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\TermsConditionController;

// Dashboard
Route::get('/', function () {
    return redirect('/admin');
});


// Quotes
Route::resource('quotes', QuoteController::class);

// Invoices
Route::resource('invoices', InvoiceController::class);

// Customers
Route::resource('customers', CustomerController::class);

// Dealers
Route::resource('dealers', DealerController::class);

// Products
Route::resource('products', ProductController::class);

// Kits
Route::resource('kits', KitController::class);

// Terms & Conditions
Route::resource('terms', TermsConditionController::class);

// 🚀 NEW ROUTES for sending emails
Route::post('/quotes/{id}/send', [QuoteController::class, 'sendQuote']);
Route::post('/invoices/{id}/send', [InvoiceController::class, 'sendInvoice']);

// 🚀 NEW ROUTE for dashboard/internal
Route::middleware(['auth', 'can:viewInternalDashboard'])->get('/dashboard/internal', function () {
    return view('dashboards.internal');
})->name('dashboard.internal');

// Internal Dashboard (Admins, Internal Users)
Route::middleware(['auth', 'can:viewInternalDashboard'])->group(function () {
    Route::get('/dashboard/internal', function () {
        return view('dashboards.internal');
    })->name('dashboard.internal');
});

// Dealer Dashboard (Key Dealer, Sub-Dealer)
Route::middleware(['auth', 'can:viewDealerDashboard'])->group(function () {
    Route::get('/dashboard/dealer', function () {
        return view('dashboards.dealer');
    })->name('dashboard.dealer');
});

// UI routes for pre-built views
Route::middleware(['auth'])->group(function () {
    Route::get('/customers/view', [App\Http\Controllers\CustomerController::class, 'indexView'])->name('customers.indexView');
    Route::get('/dealers/view', [App\Http\Controllers\DealerController::class, 'indexView'])->name('dealers.indexView');
    Route::get('/quotes/create/view', [App\Http\Controllers\QuoteController::class, 'createView'])->name('quotes.createView');
    Route::get('/invoices/view/{id}', [App\Http\Controllers\InvoiceController::class, 'showView'])->name('invoices.showView');
});