<?php

namespace App\Http\Requests;

/**
 * @property string id
 * @property string board
 */
class UpdateRequest extends BaseRequest
{
    protected array $urlParams = ['id'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'    => 'required|uuid',
            'board' => 'required|string|max:9|regex:/[-XO]{9}/',
        ];
    }
}
