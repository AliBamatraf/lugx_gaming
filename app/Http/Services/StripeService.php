<?php

namespace App\Http\Services;

use App\Jobs\SendThanksForBuyingEmail;
use App\Models\Game;
use App\Mail\ThanksForBuying;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe;

class StripeService
{
    public function postStripeService(Request $request, Game $currentGame)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $quantity = $request->quantity;
        $totalPrice = (float)$currentGame->price * (int)$quantity;
        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $user = Auth::user();

        Order::create([
            'user_id' => $user->id,
            'game_id' => $currentGame->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);
        dispatch(new SendThanksForBuyingEmail($user, $currentGame));
    }
}
