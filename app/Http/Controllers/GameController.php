<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\StoreGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Services\GameService;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    // to do : take just the required fileds from db in index and show
    //Get all the games in db 
    public function index()
    {
        // get all games and create paginite
        $games = Game::select('id', 'name', 'description', 'price', 'image')
            ->with(['categories:id,name'])  // Select only 'id' and 'name' from the categories table
            ->latest()
            ->paginate(3);

        // return view with all the games
        return view('game.index', [
            'games' => $games
        ]);
    }
    //CRUD Operations Create
    public function create()
    {
        //GEt all the categories in the db
        $categories = Category::select(['id', 'name'])->get();

        return view('game.create', [
            'categories' => $categories
        ]);
    }
    //Store a newly created resource in storage.
    public function store(StoreGameRequest $request, GameService $gameService)
    {
        $gameService->storeGameService($request);

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
        $games = Game::take(5)->select('id', 'image')
            ->with(['categories:id,name'])->get();

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

        //get just the id and name of categories in the db 
        $categories = Category::select(['id', 'name'])->get();

        return view('game.edit', [
            'game' =>  $game,
            'categories' => $categories
        ]);
    }
    //Update the specified resource in storage.
    public function update(UpdateGameRequest $request, Game $game, GameService $gameService)
    {
        $gameService->updateGameService($request, $game);
        return back()->with([
            'success' => 'the game has been updated'
        ]);
    }
    //Remove the specified resource from storage.
    public function destroy(Game $game, GameService $gameService)
    {
        $gameService->deleteGameService($game);
        return back()->with([
            'success' => 'the game has been deleted'
        ]);
    }
}
