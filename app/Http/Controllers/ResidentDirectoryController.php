<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentDirectoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Fetch residents with their apartment and building relationships, paginated
        $residents = Resident::all();

        // Pass data to the view
        return view('residentDirectory', compact('residents'));
    }
}