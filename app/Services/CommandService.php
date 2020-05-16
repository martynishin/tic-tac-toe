<?php

namespace App\Services;

use App\Models\Game;
use App\Repositories\GameRepository;
use Exception;

/**
 * Class CommandService
 *
 * @package App\Services
 */
class CommandService
{
    /**
     * @var ControlService
     */
    private ControlService $controlService;

    /**
     * @var GameService
     */
    private GameService $gameService;

    /**
     * @var GameRepository
     */
    private GameRepository $repository;

    /**
     * CommandService constructor.
     *
     * @param ControlService $controlService
     * @param GameService    $gameService
     * @param GameRepository $repository
     */
    public function __construct(
        ControlService $controlService,
        GameService $gameService,
        GameRepository $repository
    ) {
        $this->controlService = $controlService;
        $this->gameService    = $gameService;
        $this->repository     = $repository;
    }

    /**
     * @return Game
     */
    public function create(): Game
    {
        return $this->repository->create([
            'board'  => Game::DEFAULT_BOARD_SCHEMA,
            'status' => Game::RUNNING,
        ]);
    }

    /**
     * @param string $id
     * @param string $board
     *
     * @return Game
     */
    public function update(string $id, string $board): Game
    {
        $board = str_split($board);

        $this->controlService->validate($id, $board);

        if ($game = $this->updateIfWon($id, $board, Game::CROSS)) {
            return $game;
        }

        if ($game = $this->updateIfDraw($id, $board)) {
            return $game;
        }

        $board = $this->gameService->makeComputerMove($board);

        if ($game = $this->updateIfWon($id, $board, Game::NOUGHT)) {
            return $game;
        }

        return $this->repository->update(['board' => $board], $id);
    }

    /**
     * @param string $id
     * @param array  $board
     * @param string $mark
     *
     * @return Game|null
     */
    private function updateIfWon(string $id, array $board, string $mark): ?Game
    {
        $result = $this->controlService->checkWin($board, $mark);

        if ($result) {
            return $this->repository->update([
                'board'  => $board,
                'status' => $mark === Game::CROSS ? Game::X_WON : Game::O_WON,
            ], $id);
        }

        return null;
    }

    /**
     * @param string $id
     * @param array  $board
     *
     * @return Game|null
     */
    private function updateIfDraw(string $id, array $board): ?Game
    {
        $result = array_search(Game::DASH, $board);

        if ($result === false) {
            return $this->repository->update([
                'board'  => $board,
                'status' => Game::DRAW,
            ], $id);
        }

        return null;
    }

    /**
     * @param string $id
     *
     * @return void
     * @throws Exception
     */
    public function delete(string $id): void
    {
        $this->repository->deleteById($id);
    }
}
