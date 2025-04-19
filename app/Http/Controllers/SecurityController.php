<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:security');
    }

    public function dashboard()
    {
        $todayVisitors = Visitor::whereDate('visit_date', Carbon::today())->count();
        $pendingVisitors = Visitor::where('status', 'pending')->count();
        $checkedInVisitors = Visitor::where('status', 'checked_in')->count();
        $recentVisitors = Visitor::with('resident')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('guest', compact('todayVisitors', 'pendingVisitors', 'checkedInVisitors', 'recentVisitors'));
    }

    public function visitors()
    {
        $visitors = Visitor::with('resident')->orderBy('created_at', 'desc')->paginate(15);
        return view('security.visitors.index', compact('visitors'));
    }

    public function showVisitor(Visitor $visitor)
    {
        return view('security.visitors.show', compact('visitor'));
    }

    public function checkIn(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'checked_in',
        ]);

        return redirect()->route('security.visitors')->with('success', 'Visitor checked in successfully');
    }

    public function checkOut(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'checked_out',
        ]);

        return redirect()->route('security.visitors')->with('success', 'Visitor checked out successfully');
    }

    public function checkinPage()
    {
        $pendingVisitors = Visitor::where('status', 'pending')
            ->whereDate('visit_date', Carbon::today())
            ->with('resident')
            ->orderBy('created_at', 'desc')
            ->get();

        $residents = Resident::orderBy('name')->get();

        return view('security.checkin', compact('pendingVisitors', 'residents'));
    }

    public function processCheckin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'resident_id' => 'required|exists:residents,id',
            'purpose' => 'required|string|max:255',
            'vehicle_number' => 'nullable|string|max:20',
        ]);

        $visitor = Visitor::create([
            'name' => $validated['name'],
            'id_number' => $validated['id_number'],
            'phone' => $validated['phone'],
            'resident_id' => $validated['resident_id'],
            'purpose' => $validated['purpose'],
            'vehicle_number' => $validated['vehicle_number'] ?? null,
            'visit_date' => Carbon::today(),
            'status' => 'checked_in',
            'checked_in_at' => Carbon::now(),
            'checked_in_by' => auth()->id(),
        ]);

        return redirect()->route('security.visitors')->with('success', 'New visitor checked in successfully');
    }
}
