<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorCheckInController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('security.role');
    }

    public function index()
    {
        return view('visitor.checkin');
    }
}
