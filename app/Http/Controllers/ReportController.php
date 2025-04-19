<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Resident;
use App\Models\Apartment;

class ReportController extends Controller
{
    /**
     * Display the reports index page.
     */
    public function index()
    {
        // Get data for summary statistics
        $totalVisitors = Visitor::count();
        $activeVisitors = Visitor::count();
        $totalResidents = Resident::count();
        $totalApartments = Apartment::count();

        return view('reports.index', compact(
            'totalVisitors',
            'activeVisitors',
            'totalResidents',
            'totalApartments'
        ));
    }

    /**
     * Generate a printable summary report.
     */
    public function generateSummaryReport()
    {
        // Get data for the report
        $totalVisitors = Visitor::count();
        $activeVisitors = Visitor::count();
        $totalResidents = Resident::count();
        $totalApartments = Apartment::count();

        // Get visitor traffic data for the last 7 days
        $startDate = now()->subDays(7);
        $endDate = now();

        $visitorTraffic = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Get most visited floors
        $mostVisitedFloors = Visitor::selectRaw('floor, COUNT(*) as visits')
            ->groupBy('floor')
            ->orderByDesc('visits')
            ->limit(5)
            ->get();

        $data = [
            'totalVisitors' => $totalVisitors,
            'activeVisitors' => $activeVisitors,
            'totalResidents' => $totalResidents,
            'totalApartments' => $totalApartments,
            'visitorTraffic' => $visitorTraffic,
            'mostVisitedFloors' => $mostVisitedFloors,
            'generatedDate' => now()->format('Y-m-d H:i:s'),
        ];

        // Return a view that's designed to be printed
        return view('reports.summary', $data);
    }
}
