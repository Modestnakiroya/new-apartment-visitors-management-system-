<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Visitor;
use App\Models\Apartment; // Changed from Unit to match your database structure

class VisitorManagementController extends Controller
{
    public function index()
    {
        // Get statistics
        $currentVisitorsCount = Visit::where('status', 'active')->count();
        $expectedTodayCount = Visit::whereDate('visit_date', today())
            ->where('status', 'scheduled')
            ->count();
        $totalTodayCount = Visit::whereDate('visit_date', today())->count();
        $totalMonthCount = Visit::whereMonth('visit_date', now()->month)->count();
        
        // Get current visitors
        $currentVisits = Visit::with(['visitor', 'resident'])
            ->where('status', 'active')
            ->latest('check_in_time')
            ->take(5)
            ->get();
        
        // Get scheduled visits
        $scheduledVisits = Visit::with(['visitor', 'resident'])
            ->where('status', 'scheduled')
            ->orderBy('visit_date')
            ->orderBy('expected_arrival_time')
            ->take(5)
            ->get();
        
        // Get visit history
        $completedVisits = Visit::with(['visitor', 'resident'])
            ->where('status', 'completed')
            ->latest('departure_time')
            ->take(5)
            ->get();
        $scheduledVisits = Visit::with(['visitor', 'resident.apartment'])
            ->where('status', 'scheduled')
            ->orderBy('visit_date')
            ->orderBy('expected_arrival_time')
            ->get();

        
        // Get apartments for filtering
        $apartments = Apartment::orderBy('number')->get();
        
        
        return view('visitorManagement', compact(
            'currentVisitorsCount', 'expectedTodayCount', 'totalTodayCount', 'totalMonthCount',
            'currentVisits', 'scheduledVisits', 'completedVisits', 'apartments'
        ));
    }
    
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            //'pass_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            //'resident_name' => 'required|string|max:255',
            //'apartment_number' => 'required|string|max:50',
            //'visit_date' => 'required|date',
            //'visit_time' => 'required',
            //'purpose' => 'required|string|max:100',
            //'other_purpose' => 'nullable|string|max:255',
        ]);

        $visitorData = $validated;

        try {
            Mail::to($visitorData['email'])->send(new VisitorPassMail($visitorData));
            return response()->json(['success' => true, 'message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $apartment = $request->input('apartment');
        $status = $request->input('status');
        $sortBy = $request->input('sort_by');
        
        $query = Visit::with(['visitor', 'resident']);
        
        // Apply search filter
        if ($search) {
            $query->whereHas('visitor', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id_number', 'like', "%{$search}%");
            });
        }
        
        // Apply apartment filter
        if ($apartment) {
            $query->whereHas('resident', function($q) use ($apartment) {
                $q->where('apartment_id', $apartment);
            });
        }
        
        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }
        
        // Apply sorting
        switch ($sortBy) {
            case 'time-asc':
                $query->orderBy('check_in_time', 'asc');
                break;
            case 'time-desc':
                $query->orderBy('check_in_time', 'desc');
                break;
            case 'name':
                $query->join('visitors', 'visits.visitor_id', '=', 'visitors.id')
                      ->orderBy('visitors.name');
                break;
            case 'apartment':
                $query->join('residents', 'visits.resident_id', '=', 'residents.id')
                      ->join('apartments', 'residents.apartment_id', '=', 'apartments.id')
                      ->orderBy('apartments.apartment_number');
                break;
            default:
                $query->latest('check_in_time');
                break;
        }
        
        $visits = $query->paginate(10);
        
        return view('visitorManagement.search-results', compact('visits'));
    }
}