<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        return User::orderBy('created_at', 'desc')->get();
    }

    // GET /api/users/{id}
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // POST /api/users
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,key_dealer,sub_dealer',
            'region_id' => 'nullable|exists:sub_dealer_regions,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // DELETE /api/users/{id}
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }

    // GET /users/{user}/edit
    public function edit(User $user)
    {
        $dealers = Dealer::all();
        $roles = UserRole::all();
        return view('users.edit', compact('user', 'dealers', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:255',
            'dealer_id' => 'nullable|exists:dealers,id',
            'user_role_id' => 'required|exists:user_roles,id',
        ]);
        $user->update($validated);
        return redirect()->route('users.index')->with('status', 'User updated successfully!');
    }
}
