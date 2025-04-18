<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        // Get current active visits
        $currentVisits = VisitController::with(['visitor', 'unit', 'resident'])
            ->active()
            ->latest('actual_checkin_datetime')
            ->paginate(10);
            
        // Get scheduled visits
        $scheduledVisits =VisitController::with(['visitor', 'unit', 'resident'])
            ->scheduled()
            ->orderBy('expected_arrival_date')
            ->orderBy('expected_arrival_time')
            ->paginate(10);
            
        // Get completed visits
        $completedVisits = VisitController::with(['visitor', 'unit', 'resident'])
            ->completed()
            ->latest('actual_checkout_datetime')
            ->paginate(10);
            
        // Get statistics
        $currentVisitorsCount = VisitController::active()->count();
        $expectedTodayCount = VisitController::scheduled()->today()->count();
        $totalTodayCount = VisitController::where(function($query) {
            $query->where('actual_checkin_datetime', '>=', today())
                ->orWhere('expected_arrival_date', today());
        })->count();
        $totalMonthCount = VisitController::where(function($query) {
            $query->whereMonth('actual_checkin_datetime', now()->month)
                ->orWhereMonth('expected_arrival_date', now()->month);
        })->count();
        
        return view('visit-management.index', compact(
            'currentVisits', 'scheduledVisits', 'completedVisits',
            'currentVisitorsCount', 'expectedTodayCount', 
            'totalTodayCount', 'totalMonthCount'
        ));
    }
    
    public function create()
    {
        // Get data for dropdown selects
        $visitors = VisitController::all();
        $units = Unit::all();
        $residents = Resident::all();
        
        return view('visit-management.create', compact('visitors', 'units', 'residents'));
    }
    
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'unit_id' => 'required|exists:units,id',
            'resident_id' => 'required|exists:residents,id',
            'visit_type' => 'required|string|max:50',
            'expected_arrival_date' => 'required|date',
            'expected_arrival_time' => 'required',
            'expected_departure_date' => 'required|date',
            'expected_departure_time' => 'required',
            'notes' => 'nullable|string',
        ]);
        
        // Create the visit
        $visit = VisitController::create([
            'visitor_id' => $validated['visitor_id'],
            'unit_id' => $validated['unit_id'],
            'resident_id' => $validated['resident_id'],
            'visit_type' => $validated['visit_type'],
            'expected_arrival_date' => $validated['expected_arrival_date'],
            'expected_arrival_time' => $validated['expected_arrival_time'],
            'expected_departure_date' => $validated['expected_departure_date'],
            'expected_departure_time' => $validated['expected_departure_time'],
            'status' => 'scheduled',
            'notes' => $validated['notes'] ?? null,
        ]);
        
        // Handle vehicle information if provided
        if ($request->filled('license_plate') || $request->filled('vehicle_model')) {
            Vehicle::create([
                'visit_id' => $visit->id,
                'license_plate' => $request->input('license_plate'),
                'vehicle_model' => $request->input('vehicle_model'),
                'color' => $request->input('vehicle_color'),
            ]);
        }
        
        return redirect()->route('visits.show', $visit)
            ->with('success', 'Visit scheduled successfully.');
    }
    
    public function show(VisitController $visit)
    {
        // Load related data
        $visit->load(['visitor', 'unit', 'resident', 'vehicle', 'activityLogs']);
        
        return view('visit-management.show', compact('visit'));
    }
    
    public function edit(VisitController $visit)
    {
        // Get data for dropdown selects
        $visitors = VisitController::all();
        $units = Unit::all();
        $residents = Resident::all();
        
        return view('visit-management.edit', compact('visit', 'visitors', 'units', 'residents'));
    }
    
    public function update(Request $request, VisitController $visit)
    {
        // Validate the request
        $validated = $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'unit_id' => 'required|exists:units,id',
            'resident_id' => 'required|exists:residents,id',
            'visit_type' => 'required|string|max:50',
            'expected_arrival_date' => 'required|date',
            'expected_arrival_time' => 'required',
            'expected_departure_date' => 'required|date',
            'expected_departure_time' => 'required',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);
        
        // Update the visit
        $visit->update($validated);
        
        // Update vehicle information if provided
        if ($visit->vehicle) {
            $visit->vehicle->update([
                'license_plate' => $request->input('license_plate'),
                'vehicle_model' => $request->input('vehicle_model'),
                'color' => $request->input('vehicle_color'),
            ]);
        } else if ($request->filled('license_plate') || $request->filled('vehicle_model')) {
            Vehicle::create([
                'visit_id' => $visit->id,
                'license_plate' => $request->input('license_plate'),
                'vehicle_model' => $request->input('vehicle_model'),
                'color' => $request->input('vehicle_color'),
            ]);
        }
        
        return redirect()->route('visits.show', $visit)
            ->with('success', 'Visit updated successfully.');
    }
    
    public function destroy(VisitController $visit)
    {
        // Delete associated vehicle and activity logs
        if ($visit->vehicle) {
            $visit->vehicle->delete();
        }
        $visit->activityLogs()->delete();
        
        // Delete the visit
        $visit->delete();
        
        return redirect()->route('visits.index')
            ->with('success', 'Visit deleted successfully.');
    }
    
    public function checkIn(VisitController $visit)
    {
        // Update visit status and check-in time
        $visit->update([
            'status' => 'active',
            'actual_checkin_datetime' => now(),
        ]);
        
        // Log the check-in activity
        ActivityLog::create([
            'visit_id' => $visit->id,
            'activity_type' => 'check-in',
            'description' => 'Check-in at Main Entrance',
            'location' => 'Main Entrance',
            'timestamp' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Visitor checked in successfully.');
    }
    
    public function checkOut(VisitController $visit)
    {
        // Update visit status and check-out time
        $visit->update([
            'status' => 'completed',
            'actual_checkout_datetime' => now(),
        ]);
        
        // Log the check-out activity
        ActivityLog::create([
            'visit_id' => $visit->id,
            'activity_type' => 'check-out',
            'description' => 'Check-out at Main Entrance',
            'location' => 'Main Entrance',
            'timestamp' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Visitor checked out successfully.');
    }
    
    public function calendar()
    {
        // Get all visits for calendar view (both active and scheduled)
        $visits = VisitController::with(['visitor', 'unit', 'resident'])
            ->where('status', 'active')
            ->orWhere('status', 'scheduled')
            ->get()
            ->groupBy(function($visit) {
                return $visit->expected_arrival_date->format('Y-m-d');
            });
        
        return view('visit-management.calendar', compact('visits'));
    }
}
