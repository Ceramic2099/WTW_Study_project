<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFilmRequest extends FormRequest
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
            'imdb' => ['required', 'regex:/^(?:[1-9]|1[0-9]|2[0-4])$/', 'unique:films,imdb_id']
        ];
    }

    public function messages()
    {
        return [
            'imdb.regex' => 'imdb id должен быть передан в формате от 1 до 24',
            'imdb.unique' => 'Такой фильм уже есть'
        ];
    }
}
