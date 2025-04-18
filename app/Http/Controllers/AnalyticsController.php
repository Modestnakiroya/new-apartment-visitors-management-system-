<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Visit;


class AnalyticsController extends Controller
{
    public function index()
{
    // Get top 5 most frequent visitors this month
    $mostFrequentVisitors = Visit::select('visitor_id')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('visitor_id')
        ->selectRaw('visitor_id, COUNT(*) as visit_count')
        ->orderByDesc('visit_count')
        ->with('visitor') // Eager load visitor details
        ->take(5)
        ->get();

        // Apartments with most visitors this month
        $apartmentsWithMostVisitors = Visit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->with('resident.apartment')
            ->get()
            ->groupBy(function ($visit) {
                return $visit->resident->apartment->apartment_number ?? 'Unknown';
            })
            ->map(function ($visits) {
                return count($visits);
            })
            ->sortDesc()
            ->take(5);
            //visit purposes
            $visitPurposes = Visit::select('purpose')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('purpose')
            ->selectRaw('purpose, COUNT(*) as count')
            ->get();
    
        // Process purposes into labels and data for the chart
        $purposeLabels = $visitPurposes->pluck('purpose');
        $purposeCounts = $visitPurposes->pluck('count');
        // Pass as JSON for JavaScript
       $purposeLabelsJson = $purposeLabels->toJson();
       $purposeCountsJson = $purposeCounts->toJson();
       
    

    return view('analytics', compact('mostFrequentVisitors','apartmentsWithMostVisitors','purposeLabels','purposeCounts','visitPurposes','purposeLabelsJson','purposeCountsJson'));
}


}
