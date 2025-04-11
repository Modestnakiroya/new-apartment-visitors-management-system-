<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with(['apartment', 'user'])
            ->orderBy('name')
            ->paginate(15);

        return view('residents.index', compact('residents'));
    }

    public function create()
    {
        $apartments = Apartment::all();
        $users = User::all();
        return view('residents.create', compact('apartments', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'apartment_id' => 'required|exists:apartments,id',
        ]);

        try {
            Resident::create($validated);
            return redirect()->route('residents.index')
                ->with('success', 'Resident added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating resident: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        $apartments = Apartment::all();
        $users = User::all();

        return view('residents.edit', compact('resident', 'apartments', 'users'));
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'apartment_id' => 'required|exists:apartments,id',
        ]);

        $resident->update($validated);

        return redirect()->route('residents.index')
            ->with('success', 'Resident updated successfully');
    }
}
