<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Contracts\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{

    public function getAll()
    {
        return Game::all();
    }

}