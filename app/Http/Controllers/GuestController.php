<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:security']);
    }

    public function index()
    {
        return view('guest');
    }
    //submit visitor details
    public function uploadVisitorDetails(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_number' => 'required|string|max:30',
            'resident_id' => 'required|exists:residents,id',
            'purpose' => 'required|string|max:255',
            'vehicle_number' => 'nullable|string|max:20',
        ]);

        // Create new visitor
        $visitor = Visitor::create([
            'name' => $validated['full_name'],
            'phone' => $validated['phone_number'],
            'email' => $validated['email'] ?? null,
            'id_number' => $validated['id_number'],
            'resident_id' => $validated['resident_id'],
            'purpose' => $validated['purpose'],
            'vehicle_number' => $validated['vehicle_number'] ?? null,
            'status' => 'pending',
            'visit_date' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Visitor information has been recorded successfully.');
    }
}
