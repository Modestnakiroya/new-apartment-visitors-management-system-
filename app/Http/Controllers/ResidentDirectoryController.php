<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentDirectoryController extends Controller
{
    public function index()
    {
        
        return view('residentDirectory');
    }
}
