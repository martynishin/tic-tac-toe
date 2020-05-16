<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\FindRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Game;
use App\Services\CommandService;
use App\Services\QueryService;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class GameController
 *
 * @package App\Http\Controllers
 */
class GameController extends Controller
{
    /**
     * @param QueryService $service
     *
     * @return Collection
     */
    public function list(QueryService $service): Collection
    {
        return $service->all();
    }

    /**
     * @param FindRequest  $request
     * @param QueryService $service
     *
     * @return Game
     */
    public function find(FindRequest $request, QueryService $service): Game
    {
        return $service->find($request->id);
    }

    /**
     * @param CreateRequest  $request
     * @param CommandService $service
     *
     * @return Game
     */
    public function create(CreateRequest $request, CommandService $service): Game
    {
        return $service->create();
    }

    /**
     * @param UpdateRequest  $request
     * @param CommandService $commandService
     *
     * @return Game
     */
    public function update(UpdateRequest $request, CommandService $commandService): Game
    {
        return $commandService->update($request->id, $request->board);
    }

    /**
     * @param DeleteRequest  $request
     * @param CommandService $service
     *
     * @return string
     * @throws Exception
     */
    public function delete(DeleteRequest $request, CommandService $service): string
    {
        $service->delete($request->id);

        return 'Game successfully deleted';
    }
}
