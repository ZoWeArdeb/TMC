<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{

    public function getAll()
    {
        return Team::all();
    }

}