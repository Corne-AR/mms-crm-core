<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    // GET /api/permissions
    public function index()
    {
        // TODO: Implement permissions listing (Spatie removed)
        return response()->json(['message' => 'Permissions listing not implemented'], 501);
    }

    // POST /api/permissions
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'required|string',
        ]);

        // TODO: Implement permission creation (Spatie removed)
        $permission = [
            'name' => $validated['name'],
            'guard_name' => $validated['guard_name'],
        ];

        return response()->json($permission, 201);
    }
}
