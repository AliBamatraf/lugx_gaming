<?php

namespace App\Http\Controllers;

use App\Http\Services\StripeService;
use App\Models\Game;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request, Game $currentGame): View
    {
        return view('game.stripe', [
            'currentGame' => $currentGame,
            'quantity' => $request->quantity
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, Game $currentGame, StripeService $stripeService): RedirectResponse
    {
        $stripeService->postStripeService($request, $currentGame);
        return redirect()->route('home');
    }
}
