<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    // SignUp method
    public function register(Request $request)
    {
        // validate the user enterd value 
        $input = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        //Create User
        $user = User::Create($input);

        //Login the registerd user
        Auth::login($user);

        //send the user to verfiy email event
        event(new Registered($user));

        //assign user to role
        $role = Role::findByName('user');
        $user->assignRole($role);

        //// un comment it if you want to add admin
        // //assign admin to role
        // $role = Role::findByName('admin');
        // $user ->assignRole($role);

        //redirect the user to the home
        return redirect()->route('verification.notice');
    }

    public function login(Request $request)
    {
        // validate the user enterd value 
        $input = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //Login the user
        if (Auth::attempt($input)) {
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'error' => 'Email or password is invaild '
            ]);
        }
    }

    public function logout(Request $request)
    {
        //logout out the current user
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    //The Email Verification Notice
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }

    public function emailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    public function resendEmailVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    //Forgot password
    public function passwordEmail(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    //Mange user page only admin role can acesss
    public function mangeUsers()
    {
        $users = User::paginate(10);
        return view('auth.mangeUsers', compact('users'));
    }

    //Delete user only admin can do it
    public function deleteUser(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('fail', 'This user can not be deleted');
        } elseif (Auth::user() == $user) {
            return back()->with('fail', 'You can not delete you self');
        } else {
            $user->delete();

            return back()->with('success');
        }
    }
}
