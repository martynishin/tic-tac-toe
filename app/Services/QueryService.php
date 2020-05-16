<?php

namespace App\Services;

use App\Models\Game;
use App\Repositories\GameRepository;
use Illuminate\Support\Collection;

/**
 * Class QueryService
 *
 * @package App\Services
 */
class QueryService
{
    /**
     * @var GameRepository
     */
    private GameRepository $repository;

    /**
     * QueryService constructor.
     *
     * @param GameRepository $repository
     */
    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * @param string $id
     *
     * @return Game
     */
    public function find(string $id): Game
    {
        return $this->repository->find($id);
    }
}
