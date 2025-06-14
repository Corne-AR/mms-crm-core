<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        return Invoice::with('items')->get();
    
    public function showView($id) {
        return view('invoices.show');
    }
}

    public function store(Request $request) {
        $data = $request->validate([
            'quote_id' => 'required|exists:quotes,id',
            'invoice_number' => 'required|unique:invoices',
            'invoice_date' => 'required|date',
            'status' => 'required|string',
            'subtotal' => 'required|numeric',
            'vat_amount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'currency' => 'required|string'
        ]);
        return Invoice::create($data);
    
    public function showView($id) {
        return view('invoices.show');
    }
}

    public function show(Invoice $invoice) {
        return $invoice->load('items');
    
    public function showView($id) {
        return view('invoices.show');
    }
}

    public function update(Request $request, Invoice $invoice) {
        $invoice->update($request->all());
        return $invoice;
    
    public function showView($id) {
        return view('invoices.show');
    }
}

    public function destroy(Invoice $invoice) {
        $invoice->delete();
        return response()->noContent();
    
    public function showView($id) {
        return view('invoices.show');
    }
}

    public function showView($id) {
        return view('invoices.show');
    }
}