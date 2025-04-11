<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::withCount('residents')
            ->orderBy('floor')
            ->orderBy('apartment_number')
            ->paginate(15);

        return view('apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('apartments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_name' => 'required|string|max:100',
            'apartment_number' => 'required|string|max:50',
            'floor' => 'required|integer|min:1',
            'number_of_rooms' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Set default status
        $validated['status'] = 'vacant';

        try {
            Apartment::create($validated);
            return redirect()->route('apartments.index')
                ->with('success', 'Apartment added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating apartment: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);

        return view('apartments.edit', compact('apartment'));
    }

    public function update(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);

        $validated = $request->validate([
            'floor' => 'required|integer|min:1',
            'number' => 'required|string|max:10',
            'description' => 'nullable|string|max:255',
        ]);

        $apartment->update($validated);

        return redirect()->route('apartments.index')
            ->with('success', 'Apartment updated successfully');
    }
}
