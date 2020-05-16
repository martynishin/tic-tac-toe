<?php

namespace App\Chains\SyntaxValidation;

use App\Models\Game;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class MarkValidator
 *
 * @package App\Chains\SyntaxValidation
 */
class MarkValidator extends Validator
{
    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    public function validate(Collection $diff, Collection $oldBoard): void
    {
        if ($diff->count() === 1 && $diff->first() !== Game::CROSS) {
            throw new BadRequestHttpException('Invalid mark! Please, use cross.');
        }

        $this->next($diff, $oldBoard);
    }
}
