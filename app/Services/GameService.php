<?php

namespace App\Services;

use App\Models\Game;

/**
 * Class GameService
 *
 * @package App\Services
 */
class GameService
{
    /**
     * @param array $board
     *
     * @return array
     */
    public function makeComputerMove(array $board): array
    {
        $emptyCells = $this->getEmptyCells($board);

        $randIndex = $this->getRandIndex($emptyCells);

        $board[$randIndex] = Game::NOUGHT;

        return $board;
    }

    /**
     * @param array $board
     *
     * @return array
     */
    private function getEmptyCells(array $board): array
    {
        return array_filter($board, function ($mark) {
            return $mark === Game::DASH;
        });
    }

    /**
     * @param array $emptyCells
     *
     * @return int
     */
    private function getRandIndex(array $emptyCells): int
    {
        return array_rand($emptyCells);
    }
}
