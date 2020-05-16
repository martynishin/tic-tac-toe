<?php

namespace App\Services;

use App\Chains\SyntaxValidation\Validator;
use App\Chains\WinInspection\WinInspector;
use App\Models\Game;
use App\Repositories\GameRepository;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ControlService
 *
 * @package App\Services
 */
class ControlService
{
    /**
     * @var Validator
     */
    private Validator $validator;

    /**
     * @var WinInspector
     */
    private WinInspector $winInspector;

    /**
     * @var GameRepository
     */
    private GameRepository $repository;

    /**
     * ControlService constructor.
     *
     * @param Validator      $validator
     * @param WinInspector   $winInspector
     * @param GameRepository $repository
     */
    public function __construct(
        Validator $validator,
        WinInspector $winInspector,
        GameRepository $repository
    ) {
        $this->validator    = $validator;
        $this->winInspector = $winInspector;
        $this->repository   = $repository;
    }

    /**
     * @param string $id
     * @param array  $board
     *
     * @return void
     */
    public function validate($id, array $board): void
    {
        /** @var Game $game */
        $game = $this->repository->find($id);

        $this->checkStatus($game);

        $oldBoard = new Collection(str_split($game->board));

        $board = new Collection($board);

        $diff = $board->diffAssoc($oldBoard);

        $this->validator->validate($diff, $oldBoard);
    }

    /**
     * @param Game $game
     *
     * @return void
     */
    private function checkStatus(Game $game): void
    {
        if ($game->status !== Game::RUNNING) {
            throw new UnprocessableEntityHttpException('This game has finished!');
        }
    }

    /**
     * @param array  $board
     * @param string $mark
     *
     * @return bool
     */
    public function checkWin(array $board, string $mark): bool
    {
        return $this->winInspector->check(array_chunk($board, 3), $mark);
    }
}
