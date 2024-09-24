<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    //return home page
    public function home()
    {
        // get some games in home page
        $games = Game::take(6)->with('categories')->get();

        //get some categories in home page
        $categories = Category::take(5)->get();

        // return view with all the games
        return view('home.home', [
            'games' => $games,
            'categories' => $categories
        ]);
    }
    //search method suggestions
    public function fetchSuggestions(Request $request)
    {
        $query = $request->input('query');
        $suggestions = Game::where('name', 'like', "%$query%")->limit(5)->get(['id', 'name']);

        return response()->json($suggestions);
    }
    //search method to look for a game
    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Game::where('name', 'like', "%$search%")->get();

        return view('game.show', compact('results', 'search'));
    }
    //Display our shop page
    public function shop()
    {
        // get all games and create paginite
        $games = Game::with('categories')->latest()->paginate(8);

        //get the categories
        $categories = Category::all();

        // return view with all the games
        return view('home.shop', [
            'games' => $games,
            'categories' => $categories
        ]);
    }
    //Get logged user orders
    public function orders()
    {
        //Get current user
        $user = Auth::user();

        //Get current user orders
        $orders = Order::with('game')->where('user_id', '=', $user->id)->paginate(10);
        return view('home.orders', ['orders' => $orders]);
    }
}
