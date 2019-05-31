<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:256',
            'body' => 'string|max:1024',
            'affiche' => 'required|image|mimes:jpeg,png,jpg,,svg',
            'img' => 'required|image|mimes:jpeg,png,jpg,,svg',
            'note' => 'required|integer',
            'date' => 'required|date',
            'user_ids'   => 'array|nullable',
            'user_ids.*' => 'exists:users,id', //

//            'user_id'   => 'required|integer',
        ];
    }
}
