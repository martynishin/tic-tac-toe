<?php

namespace App\Chains\SyntaxValidation;

use App\Models\Game;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class InvalidMoveValidator
 *
 * @package App\Chains\WinInspection
 */
class InvalidMoveValidator extends Validator
{
    /**
     * @param Collection $diff
     * @param Collection $oldBoard
     *
     * @return void
     */
    public function validate(Collection $diff, Collection $oldBoard): void
    {
        if ($oldBoard->get($diff->keys()->first()) !== Game::DASH) {
            throw new BadRequestHttpException('Invalid move!');
        }

        $this->next($diff, $oldBoard);
    }
}
