<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest');
    }

    public function uploadVisitorDetails(Request $request)
    {
        $visitors = new Visitor();
        $visitors->name = $request->input('name');
        $visitors->phone = $request->input('phone');
        $visitors->email = $request->input('email');
        $visitors->id_number = $request->input('id_number');
        $challenges->number_of_questions = $request->input('number_of_questions');

        $challenges->save();

        return back()->with('success', 'Challenge Parameters uploaded successfully.');
    }
}
