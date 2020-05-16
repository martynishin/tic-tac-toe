<?php

namespace App\Providers;

use App\Chains\SyntaxValidation\InvalidMoveValidator;
use App\Chains\SyntaxValidation\MadeMoveValidator;
use App\Chains\SyntaxValidation\ManyMovesValidator;
use App\Chains\SyntaxValidation\MarkValidator;
use App\Chains\SyntaxValidation\Validator;
use App\Chains\WinInspection\InspectDownLeftDiagonal;
use App\Chains\WinInspection\InspectDownRightDiagonal;
use App\Chains\WinInspection\InspectRows;
use App\Chains\WinInspection\WinInspector;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

/**
 * Class ChainServiceProvider
 *
 * @package App\Providers
 */
class ChainServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerValidator();
        $this->registerWinInspector();
    }

    /**
     * @return void
     */
    private function registerValidator(): void
    {
        $this->app->bind(Validator::class, function (Application $app) {
            return $app->make(MadeMoveValidator::class)
                ->setNext($app->make(InvalidMoveValidator::class)
                    ->setNext($app->make(MarkValidator::class)
                        ->setNext($app->make(ManyMovesValidator::class)
                        )));
        });
    }

    /**
     * @return void
     */
    private function registerWinInspector(): void
    {
        $this->app->bind(WinInspector::class, function (Application $app) {
            return $app->make(InspectRows::class)
                ->setNext($app->make(InspectDownRightDiagonal::class)
                    ->setNext($app->make(InspectDownLeftDiagonal::class)
                    ));
        });
    }
}
