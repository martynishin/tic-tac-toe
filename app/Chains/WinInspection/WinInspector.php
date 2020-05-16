<?php

namespace App\Chains\WinInspection;

/**
 * Class WinInspector
 *
 * @package App\Chains\WinInspection
 */
abstract class WinInspector
{
    /**
     * @var WinInspector
     */
    protected $next;

    /**
     * @param array  $board
     * @param string $mark
     *
     * @return bool
     */
    public abstract function check(array $board, string $mark): bool;

    /**
     * @param WinInspector $inspector
     *
     * @return WinInspector
     */
    public function setNext(WinInspector $inspector): WinInspector
    {
        $this->next = $inspector;

        return $this;
    }

    /**
     * @param array  $board
     * @param string $mark
     *
     * @return bool
     */
    protected function next(array $board, string $mark): bool
    {
        if ($this->next) {
            return $this->next->check($board, $mark);
        }

        return false;
    }
}
