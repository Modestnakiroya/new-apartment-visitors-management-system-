<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    /**
     * Store a new resident in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('resident-form');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'apartment_number' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:residents,email',
        ]);

        // Create a new resident
        Resident::create([
            'name' => $validatedData['name'],
            'apartment_number' => $validatedData['apartment_number'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Resident added successfully.');
    }
}