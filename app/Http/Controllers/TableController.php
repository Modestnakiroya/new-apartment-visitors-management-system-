<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\pupil;
use App\Models\representative;
use Illuminate\Http\Request;
use App\Models\School;
class TableController extends Controller
{
    public function retrieveTableInformation()
    {
        // Retrieve all pupils
        $pupils = Pupil::all();
        $representatives = Representative::all();
        $schools = School::all();
        $challenges = Challenge::all();
        // Return the data to the 'pupils' view
        return view('table', [
            'pupils' => $pupils,
            'representatives' => $representatives,
            'schools' => $schools,
            'challenges'=> $challenges
        ]);

    }
    public function index()
{
    return view('tables')->with(['activePage' => 'tables']);
}
}

