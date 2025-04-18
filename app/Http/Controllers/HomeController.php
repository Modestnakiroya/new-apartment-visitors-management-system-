<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Approval;
use App\Models\Alert;
use App\Models\Visit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       /// Current Visitors: Those who checked in and haven't checked out
        $currentVisitors = Visit::whereNotNull('check_in_time')
            //->whereNull('check_out_time')
            ->count();

        // Expected Visitors: Those with an expected arrival today
        $expectedVisitors = Visit::whereDate('visit_date', today())->count();

        // Today's Visitors: Those who checked in today
        $todaysVisitors = Visit::whereDate('check_in_time', today())->count();

        // Overstayed Visitors: Those marked as overstayed
        $overstayedVisitors = Visit::where('departure_time', today())->count();

        // Pending Approvals
        $pendingApprovals = Approval::where('status', 'pending')->count();

        // Security Alerts
        $securityAlerts = Alert::where('resolved', false)->count();

        return view('dashboard', compact(
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
        $currentVisitors = Visit::whereNotNull('check_in_time');
        //->whereNull('check_out_time')->get();
        $expectedVisitors = Visit::whereDate('visit_date', today())->get();
        $todaysVisitors = Visit::whereDate('check_in_time', today())->get();
        $overstayedVisitors = Visit::where('departure_time', today())->get();
        $pendingApprovals = Approval::where('status', 'pending')->get();
        $securityAlerts = Alert::where('resolved', false)->get();

        return view('details', compact(
            'currentVisitors',
            'expectedVisitors',
            'todaysVisitors',
            'overstayedVisitors',
            'pendingApprovals',
            'securityAlerts'
        ));
    }
}
