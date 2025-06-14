<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        return Customer::all();
    
    public function indexView() {
        return view('customers.index');
    }
}

    public function store(Request $request) {
        $data = $request->validate([
            'company_name' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'vat_number' => 'nullable',
            'vendor_number' => 'nullable',
            'catagory' => 'required',
            'type' => 'nullable',
            'language' => 'nullable',
            'currency' => 'nullable',
            'address' => 'nullable'
        ]);
        return Customer::create($data);
    
    public function indexView() {
        return view('customers.index');
    }
}

    public function show(Customer $customer) {
        return $customer;
    
    public function indexView() {
        return view('customers.index');
    }
}

    public function update(Request $request, Customer $customer) {
        $customer->update($request->all());
        return $customer;
    
    public function indexView() {
        return view('customers.index');
    }
}

    public function destroy(Customer $customer) {
        $customer->delete();
        return response()->noContent();
    
    public function indexView() {
        return view('customers.index');
    }
}

    public function indexView() {
        return view('customers.index');
    }
}