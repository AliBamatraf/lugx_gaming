<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id' => $user->id,

                    'password' => encrypt('123456dummy')

                ]);
                //assign user to role
                $role = Role::findByName('user');
                $newUser->assignRole($role);

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login. Please try again.');
        }
    }
}
