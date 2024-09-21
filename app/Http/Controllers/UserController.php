<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // SignUp method
    public function register(RegisterRequest $request, UserService $userService)
    {
        $userService->RegisterUserService($request);
        //redirect the user to the home
        return redirect()->route('verification.notice');
    }

    public function login(LoginRequest $request)
    {
        //Login the user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'error' => 'Email or password is invaild '
            ]);
        }
    }

    public function logout(Request $request, UserService $userService)
    {
        $userService->LogoutUserService($request);

        return redirect()->route('home');
    }

    //Mange user page only admin role can acesss
    public function mangeUsers()
    {
        $users = User::paginate(10);
        return view('user.mangeUsers', compact('users'));
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
