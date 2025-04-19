<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'id_number' => ['required', 'string', 'max:50'],
            'role' => ['required', 'in:admin,security'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree' => ['required', 'accepted'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id_number' => $data['id_number'],
            'password' => bcrypt($data['password']),
        ]);
        $role = Role::where('name', $data['role'])->firstOrFail();
        $user->roles()->attach($role->id);

        return $user;
    }
}
