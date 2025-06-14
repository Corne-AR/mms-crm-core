<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API Routes - MMS CRM - FINAL VERSION 🚀

// PUBLIC TEST ROUTE (optional)
Route::get('/ping', function () {
    return response()->json(['status' => 'ok', 'message' => 'API is running 🚀']);
});

// AUTH MIDDLEWARE EXAMPLE (if needed)
// Route::middleware('auth:sanctum')->group(function () {

// --- QUOTES ---
Route::get('/quotes', 'App\Http\Controllers\QuoteController@index');
Route::get('/quotes/{id}', 'App\Http\Controllers\QuoteController@show');
Route::post('/quotes', 'App\Http\Controllers\QuoteController@store');
Route::put('/quotes/{id}', 'App\Http\Controllers\QuoteController@update');
Route::delete('/quotes/{id}', 'App\Http\Controllers\QuoteController@destroy');

// Special Quote Actions:
Route::post('/quotes/{id}/add-item', 'App\Http\Controllers\QuoteController@addItem');
Route::put('/quotes/{id}/mark-completed', 'App\Http\Controllers\QuoteController@markCompleted');
Route::put('/quotes/{id}/convert-to-invoice', 'App\Http\Controllers\QuoteController@convertToInvoice');

// --- INVOICES ---
Route::get('/invoices', 'App\Http\Controllers\InvoiceController@index');
Route::get('/invoices/{id}', 'App\Http\Controllers\InvoiceController@show');
Route::put('/invoices/{id}', 'App\Http\Controllers\InvoiceController@update');
Route::delete('/invoices/{id}', 'App\Http\Controllers\InvoiceController@destroy');

// --- PRODUCTS ---
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');
Route::post('/products', 'App\Http\Controllers\ProductController@store');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy');

// --- KITS ---
Route::get('/kits', 'App\Http\Controllers\KitController@index');
Route::get('/kits/{id}', 'App\Http\Controllers\KitController@show');
Route::post('/kits', 'App\Http\Controllers\KitController@store');
Route::put('/kits/{id}', 'App\Http\Controllers\KitController@update');
Route::delete('/kits/{id}', 'App\Http\Controllers\KitController@destroy');

// --- CUSTOMERS ---
Route::get('/customers', 'App\Http\Controllers\CustomerController@index');
Route::get('/customers/{id}', 'App\Http\Controllers\CustomerController@show');
Route::post('/customers', 'App\Http\Controllers\CustomerController@store');
Route::delete('/customers/{id}', 'App\Http\Controllers\CustomerController@destroy');

// --- DEALERS ---
Route::get('/dealers', 'App\Http\Controllers\DealerController@index');
Route::get('/dealers/{id}', 'App\Http\Controllers\DealerController@show');
Route::post('/dealers', 'App\Http\Controllers\DealerController@store');
Route::delete('/dealers/{id}', 'App\Http\Controllers\DealerController@destroy');

// --- SUB-DEALERS ---
Route::get('/subdealers', 'App\Http\Controllers\SubDealerController@index');
Route::get('/subdealers/{id}', 'App\Http\Controllers\SubDealerController@show');

// --- USERS ---
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');

// --- ROLES ---
Route::get('/roles', 'App\Http\Controllers\RolesController@index');
Route::post('/roles', 'App\Http\Controllers\RolesController@store');

// --- PERMISSIONS ---
Route::get('/permissions', 'App\Http\Controllers\PermissionsController@index');
Route::post('/permissions', 'App\Http\Controllers\PermissionsController@store');

// }); // END AUTH GROUP (if using Sanctum / Passport later)
