<?php

namespace App\Http\Controllers;

use App\Mail\ThanksForBuying;
use App\Models\Category;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    //Get all the games in db 
    public function index()
    {
        // get all games and create paginite
        $games = Game::with('categories')->latest()->paginate(2);

        // dd($games);

        // return view with all the games
        return view('game.index', [
            'games' => $games
        ]);
    }

    //CRUD Operations Create
    public function create()
    {
        //GEt all the categories in the db
        $categories = Category::all();


        return view('game.create', [
            'categories' => $categories
        ]);
    }
    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        //validate entered value
        $request->validate([
            'name' => ['required',],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'min:10'],
            'image' => ['required', 'file', 'mimes:png,jpg'],
            'category_id' => ['required'],
        ]);

        //put the categoryIds into list 
        $categoryIds = $request->input('category_id', []);

        //check the path of image
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('/images/games', $request->image);
        }

        //create the game
        $game = Game::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        //Link the category Ids to the game
        $game->categories()->attach($categoryIds);

        return back()->with([
            'success' => 'the game has been created'
        ]);
    }
    //Display the specified resource.
    public function show(Game $game)
    {
        //get the game with it categories
        $currentGame = $game->load('categories');

        //get some games to show to the user
        $games = Game::with('categories')->paginate(5);


        return view('game.show', [
            'currentGame' => $currentGame,
            'games' => $games
        ]);
    }
    //Show the form for editing the specified resource.
    public function edit(Game $game)
    {
        //load the categories assoited with the game
        $game->load('categories');

        //get all the categories in the db so user can update the current category
        $categories = Category::all();

        return view('game.edit', [
            'game' =>  $game,
            'categories' => $categories
        ]);
    }
    //Update the specified resource in storage.
    public function update(Request $request, Game $game)
    {
        //validate entered value
        $request->validate([
            'name' => ['required',],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'min:10'],
            'image' => ['file', 'mimes:png,jpg'],
            'category_id' => ['required'],
        ]);

        //put the categoryIds into list 
        $categoryIds = $request->input('category_id', []);
        //check the path of image
        $path = $game->image ?? null;

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $path = Storage::disk('public')->put('/images/games', $request->image);
        }

        //create the game
        $game->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);
        //Link the category Ids to the game
        $game->categories()->sync($categoryIds);

        

        return back()->with([
            'success' => 'the game has been updated'
        ]);
    }
    //Remove the specified resource from storage.
    public function destroy(Game $game)
    {
        Storage::disk('public')->delete($game->image);

        $game->delete();

        return back()->with([
            'success' => 'the game has been deleted'
        ]);
    }

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
    public function stripePost(Request $request, Game $currentGame): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $quantity = $request->quantity;
        $totalPrice = (double)$currentGame->price * (int)$quantity;
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

        Mail::to($user)->send(new ThanksForBuying($user, $currentGame));

        return redirect()->route('home');
    }
}
