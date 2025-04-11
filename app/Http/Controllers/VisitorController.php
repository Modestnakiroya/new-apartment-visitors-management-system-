<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Resident;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with(['resident.apartment', 'createdBy'])
            ->latest('entry_time')
            ->paginate(15);

        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        $residents = Resident::with('apartment')->get();
        return view('visitors.create', compact('residents'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'reason' => 'required|string|max:500',
            'resident_id' => 'required|exists:residents,id',
            'entry_time' => 'required|date',
            'expected_exit_time' => 'required|date|after:entry_time',
            'visit_type' => 'required|string|in:guest,delivery,service',
        ]);

        $validated['created_by'] = auth()->id();

        Visitor::create($validated);

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor checked in successfully!');
    }

    public function show($id)
    {
        $visitor = Visitor::with(['resident.apartment', 'createdBy'])
            ->findOrFail($id);

        return view('visitors.show', compact('visitor'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $visitors = Visitor::with(['resident.apartment', 'createdBy'])
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhereHas('resident', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    });
            })
            ->latest('entry_time')
            ->paginate(15);

        return view('visitors.index', [
            'visitors' => $visitors,
            'query' => $query
        ]);
    }
    public function checkout(Visitor $visitor)
    {
        if (!$visitor->isActive()) {
            return back()->with('error', 'Visitor has already checked out');
        }

        $visitor->update([
            'actual_exit_time' => now(),
        ]);

        return back()->with('success', 'Visitor checked out successfully');
    }
}
