<?php

namespace App\Chains\WinInspection;

/**
 * Class InspectDownRightDiagonal
 *
 * @package App\Chains\WinInspection
 */
class InspectDownRightDiagonal extends WinInspector
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

        foreach ($board as $k => $row) {
            if ($board[$k][$k] === $mark) {
                $count++;
            }
        }

        if ($count === 3) {
            return true;
        }

        return $this->next($board, $mark);
    }
}
