<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class UserEntryRequest extends FormRequest
{
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
            'players' => 'required|array|size:26',
            'players.*' => [
                'required',
                Rule::exists('players')->where(function (Builder $query) {
                    $query->whereIn('team_id', $this->input('teams'));
                }),
            ],
            'teams' => 'required|array|size:13',
            'teams.*' => 'required|integer|exists:teams,id',
        ];
    }
}
