<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:landlord');  // Ensure the landlord role is checked
    }

    public function index()
    {
        $residents = Resident::all();
        return view('landlord.residents.index', compact('residents'));
    }

    public function create()
    {
        return view('landlord.residents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apartment_number' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        Resident::create($validated);

        return redirect()->route('landlord.residents.index')->with('success', 'Resident added successfully');
    }

    public function edit(Resident $resident)
    {
        return view('landlord.residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apartment_number' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $resident->update($validated);

        return redirect()->route('landlord.residents.index')->with('success', 'Resident updated successfully');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return redirect()->route('landlord.residents.index')->with('success', 'Resident deleted successfully');
    }
}
