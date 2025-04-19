<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isLandlord()) {
            return redirect()->route('landlord.dashboard');
        } else {
            return redirect()->route('guest');
        }
    }

    public function welcome()
    {
        return view('welcome');
    }
    public function redirectBasedOnRole()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Redirect based on role
        switch ($user->role) {
            case 'admin':
            case 'landlord':
                return redirect()->route('landlord.dashboard');
            case 'security':
                return redirect()->route('guest');
            case 'resident':
                return redirect()->route('guest');
            default:
                return redirect()->route('guest');
        }
    }
}
