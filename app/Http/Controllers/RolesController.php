<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    // GET /api/roles
    public function index()
    {
        return UserRole::orderBy('created_at', 'desc')->get();
    }

    // POST /api/roles
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_name' => 'required|string|unique:user_roles,role_name',
        ]);

        $role = UserRole::create($validated);

        return response()->json($role, 201);
    }
}
