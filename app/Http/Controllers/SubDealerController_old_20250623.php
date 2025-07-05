<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubDealerController extends Controller
{
    // GET /api/subdealers
    public function index()
    {
        return User::where('role', 'sub_dealer')->orderBy('created_at', 'desc')->get();
    }

    // GET /api/subdealers/{id}
    public function show($id)
    {
        return User::where('role', 'sub_dealer')->findOrFail($id);
    }

    // You can add more sub-dealer specific APIs if needed
}
