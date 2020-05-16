<?php

namespace App\Repositories;

use App\Models\Game;

/**
 * Class GameRepository
 *
 * @package App\Repositories
 */
class GameRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Game::class;
    }
}
