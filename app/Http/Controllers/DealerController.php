<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Dealer::all();
        return view('dealers.index', compact('dealers'));
    }

    public function create()
    {
        return view('dealers.create');
    }

	public function store(Request $request)
	{
		$validated = $request->validate([
			'dealer_name' => 'required|string|max:255',
			'type' => 'required|string|max:255',
			'contact_person' => 'nullable|string|max:255',
			'email' => 'nullable|email|max:255',
			'phone' => 'nullable|string|max:255',
			'address' => 'nullable|string',
			'bank_details' => 'nullable|string',
			'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		if ($request->hasFile('logo_path')) {
			$path = $request->file('logo_path')->store('logos', 'public');
			$validated['logo_path'] = $path;
		}

		Dealer::create($validated);

		return redirect()->route('dealers.index')->with('status', 'Dealer created successfully!');
	}


    public function show(Dealer $dealer)
    {
        return view('dealers.show', compact('dealer'));
    }

    public function edit(Dealer $dealer)
    {
        return view('dealers.edit', compact('dealer'));
    }

    public function update(Request $request, Dealer $dealer)
    {
        $validated = $request->validate([
            'dealer_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'bank_details' => 'nullable|string',
            'logo_path' => 'nullable|string',
        ]);
        $dealer->update($validated);
        return redirect()->route('dealers.index')->with('status', 'Dealer updated successfully!');
    }

    public function destroy(Dealer $dealer)
    {
        $dealer->delete();
        return redirect()->route('dealers.index')->with('success', 'Dealer deleted successfully.');
    }
}
