<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Dealer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $customers = Customer::with('dealer')->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        $dealers = Dealer::all();
        return view('customers.create', compact('dealers'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'dealer_id' => 'nullable|exists:dealers,id',
            'currency' => 'required|string|max:10',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
                         ->with('status', 'Customer created successfully!');
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        $dealers = Dealer::all();
        return view('customers.edit', compact('customer', 'dealers'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'dealer_id' => 'nullable|exists:dealers,id',
            'currency' => 'required|string|max:10',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
                         ->with('status', 'Customer updated successfully!');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('status', 'Customer deleted successfully!');
    }
}
