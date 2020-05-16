<?php

namespace App\Chains\SyntaxValidation;

use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class MadeMoveValidator
 *
 * @package App\Chains\SyntaxValidation
 */
class MadeMoveValidator extends Validator
{
    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    public function validate(Collection $diff, Collection $oldBoard): void
    {
        if ($diff->count() === 0) {
            throw new BadRequestHttpException('Make your move!');
        }

        $this->next($diff, $oldBoard);
    }
}
