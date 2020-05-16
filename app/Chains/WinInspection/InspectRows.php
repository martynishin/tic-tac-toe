<?php

namespace App\Chains\WinInspection;

/**
 * Class InspectRows
 *
 * @package App\Chains\WinInspection
 */
class InspectRows extends WinInspector
{
    /**
     * @param array  $board
     * @param string $mark
     *
     * @return bool
     */
    public function check(array $board, string $mark): bool
    {
        static $checkCount = 1;
        $count = 0;

        foreach ($board as $row) {
            foreach ($row as $item) {
                if ($item === $mark) {
                    $count++;
                }
            }

            if ($count === 3) {
                return true;
            }

            $count = 0;
        }

        //if the winning set is not found, than make transpose of board matrix and check again
        if ($checkCount < 2) {
            $checkCount++;

            return $this->check(array_map(null, ...$board), $mark);
        }

        return $this->next($board, $mark);
    }
}
