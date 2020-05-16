<?php

namespace App\Chains\WinInspection;

/**
 * Class InspectDownLeftDiagonal
 *
 * @package App\Chains\WinInspection
 */
class InspectDownLeftDiagonal extends WinInspector
{
    /**
     * @param array  $board
     * @param string $mark
     *
     * @return bool
     */
    public function check(array $board, string $mark): bool
    {
        $count = 0;

        $size = count($board);
        foreach ($board as $k => $row) {
            if ($board[$k][$size - 1 - $k] === $mark) {
                $count++;
            }
        }

        if ($count === 3) {
            return true;
        }

        return $this->next($board, $mark);
    }
}
