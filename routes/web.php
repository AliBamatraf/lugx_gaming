<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Mail\ThanksForBuying;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\password;

//Home page in search in it Route
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/search',  [HomeController::class, 'search'])->name('home.search');
Route::get('/search/suggestions', [HomeController::class, 'fetchSuggestions']);

//Our shop route
Route::get('/home.shop', [HomeController::class, 'shop'])->name('shop');

//Contact Us route
Route::get('/contactUs', function () {
    return view('home.contactUs');
})->name('contact');




Route::middleware('auth')->group(function () {

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    //The Email Verification Notice route
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    //The Email Verification Handler route
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'emailVerification'])->middleware('signed')->name('verification.verify');

    //Resending the Verification Email
    Route::post('/email/verification-notification', [AuthController::class, 'resendEmailVerification'])->middleware('throttle:6,1')->name('verification.send');

    //User Orders
    Route::get('/home.orders', [HomeController::class, 'orders'])->name('orders');


    Route::controller(StripeController::class)->middleware('role:user')->group(function () {
        Route::post('stripe/{currentGame}', 'stripe')->name('stripe');
        Route::post('stripePayment/{currentGame}', 'stripePost')->name('stripe.post');
    });

    Route::middleware('role:admin', 'verified')->group(function () {
        Route::resource('/category', CategoryController::class);

        Route::resource('/game', GameController::class);

        Route::get('mangeUsers', [UserController::class, 'mangeUsers'])->name('user.mangeUsers');

        Route::delete('deleteUser/{user}', [UserController::class, 'deleteUser'])->name('user.deleteUser');
    });

    Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');
    Route::post('/game/{game}/responses', [ResponseController::class, 'send'])->name('responses.send');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.loginAndRegister');
    })->name('login');

    //Login with User account
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register'])->name('register');

    //Login with facebook
    Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('login/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

    //Login with google
    Route::get('google', function () {
        return view('googleAuth');
    });
    Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');

    Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    //Forgot password routes
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'passwordEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'passwordReset'])->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'passwordUpdate'])->name('password.update');

    Route::get('test', function () {
        $user = User::find(1);
        $game = Game::find(9);
        return new ThanksForBuying($user, $game);
    });

    Route::get('/chat', function () {
        return view('chat');
    });
});
