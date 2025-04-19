<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided email does not exist in our records.',
            ])->withInput($request->only('email'));
        }
        if (!Auth::validate(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ])->withInput($request->only('email'));
        }
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors([
            'email' => 'Authentication failed for unknown reasons.',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin' || $user->role === 'landlord') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'security') {
            return redirect()->route('guest');
        } elseif ($user->role === 'resident') {
            return redirect()->route('resident.dashboard');
        }

        return redirect()->intended($this->redirectPath());
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            abort(422, 'Invalid email format');
        }
    }
}
