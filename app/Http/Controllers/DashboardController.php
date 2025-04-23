<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Resident;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function adminDashboard()
    {
        // Basic counts
        $stats = [
            'totalVisitors' => Visitor::count(),
            'activeVisitors' => Visitor::active()->count(),
            'totalResidents' => Resident::count(),
            'totalApartments' => Apartment::count(),
            'occupiedApartments' => Apartment::has('residents')->count(),
            'vacantApartments' => Apartment::doesntHave('residents')->count()
        ];

        // Visitors data for charts
        $analytics = [
            'visitorsByDay' => $this->getVisitorsByDay(7),
            'popularFloors' => $this->getPopularFloors(5),
            'visitorsByHour' => $this->getVisitorsByHour(),
            'visitorsByType' => $this->getVisitorsByType()
        ];

        return view('admin.dashboard', compact('stats', 'analytics'));
    }


    private function getVisitorsByDay($days = 7)
    {
        return Visitor::select(DB::raw('DATE(entry_time) as date'), DB::raw('count(*) as count'))
            ->where('entry_time', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getPopularFloors($limit = 5)
{
    return Apartment::select('apartments.floor', DB::raw('count(visitors.id) as visits'))
        ->join('residents', 'apartments.id', '=', 'residents.apartment_id')
        ->join('visitors', 'residents.id', '=', 'visitors.resident_id')
        ->groupBy('apartments.floor')
        ->orderByDesc('visits')
        ->limit($limit)
        ->get();
}

    private function getVisitorsByHour()
    {
        return Visitor::select(DB::raw('HOUR(entry_time) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->hour => $item->count];
            });
    }

    private function getVisitorsByType()
    {
        return Visitor::select('visit_type', DB::raw('count(*) as count'))
            ->groupBy('visit_type')
            ->get()
            ->pluck('count', 'visit_type');
    }

    public function residentDashboard()
    {
        $user = auth()->user();
        $resident = Resident::where('user_id', $user->id)->firstOrFail();

        $visitors = [
            'active' => Visitor::where('resident_id', $resident->id)
                ->active()
                ->latest('entry_time')
                ->get(),
            'upcoming' => Visitor::where('resident_id', $resident->id)
                ->whereNull('entry_time')
                ->whereNotNull('expected_arrival_time')
                ->orderBy('expected_arrival_time')
                ->get(),
            'recent' => Visitor::where('resident_id', $resident->id)
                ->whereNotNull('expected_exit_time')
                ->latest('expected_exit_time')
                ->take(10)
                ->get()
        ];

        return view('resident.dashboard', compact('resident', 'visitors'));
    }
    public function securityDashboard()
    {
        $activeVisitors = Visitor::with(['resident.apartment'])
            ->whereNull('actual_exit_time')
            ->orderBy('entry_time', 'desc')
            ->get();

        $recentVisitors = Visitor::with(['resident.apartment'])
            ->orderBy('entry_time', 'desc')
            ->take(10)
            ->get();

        $expectedVisitors = Visitor::whereDate('expected_exit_time', today())
            ->whereNull('entry_time')
            ->orderBy('expected_exit_time')
            ->get();

        return view('security.dashboard', compact(
            'activeVisitors',
            'recentVisitors',
            'expectedVisitors'
        ));
    }
}
