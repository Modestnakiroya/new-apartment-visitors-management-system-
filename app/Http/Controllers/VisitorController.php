<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Visit;
use App\Models\Vehicle;
use App\Models\Resident;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        // Get all visitors with pagination
        $visitors = Visitor::paginate(10);
        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        $residents = Resident::all();
        return view('visitors.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_type' => 'required|string|max:50',
            'id_number' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'resident_id' => 'required|exists:residents,id',
            'purpose' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'expected_arrival_time' => 'required|date_format:H:i',
            'expected_departure_time' => 'required|date_format:H:i',
            'vehicle_license_plate' => 'nullable|string|max:255',
            'vehicle_model' => 'nullable|string|max:255',
            'vehicle_color' => 'nullable|string|max:255',
            'photo_id' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Save photo ID if uploaded
        if ($request->hasFile('photo_id')) {
            $validated['photo_id'] = $request->file('photo_id')->store('visitor_ids', 'public');
        }

        // Create the visitor
        $visitor = Visitor::create([
            'name' => $validated['full_name'],
            'phone' => $validated['phone_number'],
            'email' => $validated['email'],
            'id_number' => $validated['id_number'],
            // Optionally store 'photo_id' => $validated['photo_id'] if it's part of the visitor table
        ]);

        // Create the visit record
        $visit = Visit::create([
            'visitor_id' => $visitor->id,
            'resident_id' => $validated['resident_id'],
            'purpose' => $validated['purpose'],
            'visit_date' => $validated['visit_date'],
            'expected_arrival_time' => $validated['expected_arrival_time'],
            'expected_departure_time' => $validated['expected_departure_time'],
            'status' => 'Scheduled',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create vehicle if data was entered
        if (!empty($validated['vehicle_license_plate'])) {
            Vehicle::create([
                'visit_id' => $visit->id,
                'license_plate' => $validated['vehicle_license_plate'],
                'vehicle_model' => $validated['vehicle_model'],
                'color' => $validated['vehicle_color'],
            ]);
        }

        // Activity Log
        ActivityLog::create([
            'visit_id' => $visit->id,
            'activity_type' => 'Visitor Registered',
            'description' => 'A new visitor has been registered.',
            'location' => 'Entrance',
            'timestamp' => now(),
        ]);

        return redirect()->route('visitorManagement')->with('success', 'Visitor registered successfully!');

    }

    public function show(Visitor $visitor)
    {
        $visits = $visitor->visits()->latest()->paginate(5);
        return view('visitors.show', compact('visitor', 'visits'));
    }

    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_type' => 'required|string|max:50',
            'id_number' => 'required|string|max:50',
            'notes' => 'nullable|string',
            'photo_id' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo_id')) {
            $validated['photo_id'] = $request->file('photo_id')->store('visitor_ids', 'public');
        }

        $visitor->update([
            'name' => $validated['full_name'],
            'phone' => $validated['phone_number'],
            'email' => $validated['email'],
            'id_number' => $validated['id_number'],
            // If storing photo_id, include it here
        ]);

        return redirect()->route('visitors.show', $visitor)->with('success', 'Visitor updated successfully.');
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }
}
