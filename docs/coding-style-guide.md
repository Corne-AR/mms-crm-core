# MMS Design CRM — Coding Style Guide

This project follows Laravel's official conventions and the PSR-12 PHP coding standard.

---

## 📁 File Structure

- Controllers: `app/Http/Controllers`
- Requests: `app/Http/Requests`
- Views: `resources/views/{module}/{view}.blade.php`
- Routes: `routes/web.php`
- Config: `config/`
- Public assets: `public/`
- Components/Partials: `resources/views/partials/`

---

## 🧑‍💻 Coding Conventions

- **Indentation:** 4 spaces (no tabs)
- **Method names:** camelCase — e.g., `createView()`, `store()`
- **Variable names:** `$camelCase`
- **Database columns:** `snake_case` — e.g., `quote_id`, `product_id`
- **Namespaces:** Fully qualified

---

## 🎨 Blade Formatting

- Use `@extends`, `@section`, and `@include` for layouts and partials
- Always include `@csrf` in forms
- Use `@foreach`, `@if`, etc. for flow control
- Avoid PHP in Blade files; keep logic in controllers

---

## 🛡 Validation

- Create a dedicated `FormRequest` (e.g., `StoreQuoteRequest`)
- Declare rules clearly:
```php
return [
    'customer_id' => 'required|exists:customers,id',
    'product.*' => 'required|string',
    'qty.*' => 'required|numeric|min:1',
];
```

---

## ♻ Separation of Logic

- Controllers = logic coordination (no direct DB manipulation)
- Models = data interaction
- Views = pure HTML/Blade + minor JS (no business logic)

---

## ✅ Best Practices

- Use Laravel’s transaction system: `DB::beginTransaction()`
- Use `auth()->user()` to access user info
- Use `route('name')` for all URL generation
- Use named routes in views and redirects
- Secure routes with `auth` middleware
