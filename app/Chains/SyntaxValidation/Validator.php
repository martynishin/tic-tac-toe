<?php

namespace App\Chains\SyntaxValidation;

use Illuminate\Support\Collection;

/**
 * Class Validator
 *
 * @package App\Chains\SyntaxValidation
 */
abstract class Validator
{
    /**
     * @var Validator
     */
    protected $next;

    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    public abstract function validate(Collection $diff, Collection $oldBoard): void;

    /**
     * @param Validator $validator
     *
     * @return Validator
     */
    public function setNext(Validator $validator): Validator
    {
        $this->next = $validator;

        return $this;
    }

    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    protected function next(Collection $diff, Collection $oldBoard): void
    {
        if ($this->next) {
            $this->next->validate($diff, $oldBoard);
        }
    }
}
