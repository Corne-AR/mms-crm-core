<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index() {
        return Dealer::all();
    
    public function indexView() {
        return view('dealers.index');
    }
}

    public function store(Request $request) {
        $data = $request->validate([
            'dealer_name' => 'required',
            'contact_person' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'bank_details' => 'nullable',
            'type' => 'nullable',
            'logo' => 'nullable'
        ]);
        return Dealer::create($data);
    
    public function indexView() {
        return view('dealers.index');
    }
}

    public function show(Dealer $dealer) {
        return $dealer;
    
    public function indexView() {
        return view('dealers.index');
    }
}

    public function update(Request $request, Dealer $dealer) {
        $dealer->update($request->all());
        return $dealer;
    
    public function indexView() {
        return view('dealers.index');
    }
}

    public function destroy(Dealer $dealer) {
        $dealer->delete();
        return response()->noContent();
    
    public function indexView() {
        return view('dealers.index');
    }
}

    public function indexView() {
        return view('dealers.index');
    }
}