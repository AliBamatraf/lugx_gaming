<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class FacebookController extends Controller
{
    //
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home')->with('success', 'Logged in successfully!');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' =>  encrypt('123456dummy'), // Secure random password
                ]);
                //assign user to role
                $role = Role::findByName('user');
                $newUser->assignRole($role);
                Auth::login($newUser);
                return redirect()->route('home')->with('success', 'Account created and logged in successfully!');
            }
        } catch (\Exception $e) {
            Log::error('Facebook login error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
            ]);
            return redirect()->route('login')->with('error', 'Unable to login. Please try again.');
        }
    }
}
