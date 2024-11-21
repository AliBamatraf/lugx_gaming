<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserService
{
    public function registerUserService(Request $request)
    {
        //Create User
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        //assign user to role
        $role = Role::findByName('user');
        $user->assignRole($role);

        //// un comment it if you want to add admin
        // //assign admin to role
        // $role = Role::findByName('admin');
        // $user ->assignRole($role);

        //Login the registerd user
        Auth::login($user);

        //send the user to verfiy email event
        event(new Registered($user));
    }

    public function logoutUserService(Request $request)
    {
        //logout out the current user
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
