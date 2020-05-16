<?php

namespace App\Chains\SyntaxValidation;

use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class ManyMovesValidator
 *
 * @package App\Chains\SyntaxValidation
 */
class ManyMovesValidator extends Validator
{
    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    public function validate(Collection $diff, Collection $oldBoard): void
    {
        if ($diff->count() > 1) {
            throw new BadRequestHttpException('You can not make more than one move!');
        }

        $this->next($diff, $oldBoard);
    }
}
