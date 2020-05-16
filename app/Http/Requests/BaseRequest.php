<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

/**
 * Class BaseRequest
 *
 * @package App\Http\Requests
 */
abstract class BaseRequest extends FormRequest
{
    protected array $urlParams = [];

    /**
     * @param null $keys
     *
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);

        return $this->mergeUrlParametersWithRequestData($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function mergeUrlParametersWithRequestData(array $data): array
    {
        foreach ($this->urlParams as $param) {
            list($found, $routeInfo, $params) = $this->route() ?: [false, [], []];

            $data[$param] = $params[$param] ?? null;
        }

        return $data;
    }
}
