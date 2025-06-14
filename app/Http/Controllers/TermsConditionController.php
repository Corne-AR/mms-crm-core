<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'TermsConditionController ready.']);
    }
}
