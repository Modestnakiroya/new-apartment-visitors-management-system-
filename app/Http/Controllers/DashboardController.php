<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Approval;
use App\Models\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        // Current Visitors: Those who checked in and haven't checked out
        $currentVisitors = Visitor::whereNotNull('check_in')
            ->whereNull('check_out')
            ->count();

        // Expected Visitors: Those with an expected arrival today
        $expectedVisitors = Visitor::whereDate('expected_arrival', today())->count();

        // Today's Visitors: Those who checked in today
        $todaysVisitors = Visitor::whereDate('check_in', today())->count();

        // Overstayed Visitors: Those marked as overstayed
        $overstayedVisitors = Visitor::where('is_overstayed', true)->count();

        // Pending Approvals
        $pendingApprovals = Approval::where('status', 'pending')->count();

        // Security Alerts
        $securityAlerts = Alert::where('resolved', false)->count();

        return view('dashboard.index', compact(
            'currentVisitors',
            'expectedVisitors',
            'todaysVisitors',
            'overstayedVisitors',
            'pendingApprovals',
            'securityAlerts'
        ));
    }

    public function details()
    {
        // Fetch detailed data for the dashboard details page
        $currentVisitors = Visitor::whereNotNull('check_in')->whereNull('check_out')->get();
        $expectedVisitors = Visitor::whereDate('expected_arrival', today())->get();
        $todaysVisitors = Visitor::whereDate('check_in', today())->get();
        $overstayedVisitors = Visitor::where('is_overstayed', true)->get();
        $pendingApprovals = Approval::where('status', 'pending')->get();
        $securityAlerts = Alert::where('resolved', false)->get();

        return view('dashboard.details', compact(
            'currentVisitors',
            'expectedVisitors',
            'todaysVisitors',
            'overstayedVisitors',
            'pendingApprovals',
            'securityAlerts'
        ));
    }

}
