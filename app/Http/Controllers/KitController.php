<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
{
    // GET /api/kit
    public function index()
    {
        return Kit::orderBy('created_at', 'desc')->get();
    }

    // GET /api/kits/{id}
    public function show($id)
    {
        return Kit::findOrFail($id);
    }

    // POST /api/kits
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dealer_id' => 'nullable|exists:dealers,id',
            'kit_name' => 'required|string|max:255',
            'kit_description' => 'nullable|string',
            'price' => 'required|numeric',
            'vat_applicable' => 'required|boolean',
            'discount_allowed' => 'required|boolean',
        ]);

        $kit = Kit::create($validated);

        return response()->json($kit, 201);
    }

    // DELETE /api/kit/{id}
    public function destroy($id)
    {
        Kit::destroy($id);
        return response()->json(null, 204);
    }
}
